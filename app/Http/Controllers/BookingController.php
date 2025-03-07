<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function bookTicket(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'seat_number' => 'required|integer',
            'user_id' => 'required|exists:users,id'
        ]);

        $eventId = $request->event_id;
        $seatNumber = $request->seat_number;
        $userId = $request->user_id;

        $lockKey = "seat_lock:{$eventId}:{$seatNumber}";

        // Check if seat is locked
        if (!Redis::exists($lockKey) || Redis::get($lockKey) != $userId) {
            return $this->successResponse('Seat is not locked or locked by another user', 409);
        }

        DB::beginTransaction();
        try {

            $transactionId = Str::uuid();


            Ticket::create([
                'transaction_id' => $transactionId,
                'user_id' => $userId,
                'event_id' => $eventId,
                'seat_number' => $seatNumber,
                'status' => 'pending'
            ]);

            Redis::del($lockKey);

            DB::commit();
            return $this->successResponse('Ticket booked successfully', 200, $transactionId);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse('Booking failed', 500, $e->getMessage());
        }
    }
}
