<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;

class SeatLockController extends Controller
{
    use ApiResponse;

    public function lockSeat(Request $request)
    {

        $lockKey = "seat_lock:{$request->event_id}:{$request->seat_number}";


        if (Redis::exists($lockKey)) {
            return $this->successResponse('Seat already locked', 409);
        }

        // Lock seat for 5 minutes (300 seconds)
        Redis::setex($lockKey, 300, $request->user_id);
        return $this->successResponse('Seat locked for 5 minutes', 200);
    }

    public function checkSeatLock(Request $request)
    {
        $lockKey = "seat_lock:{$request->event_id}:{$request->seat_number}";

        $lockedBy = Redis::get($lockKey);

        if ($lockedBy && $lockedBy == $request->user_id) {
            return $this->successResponse('Seat is locked by you. Proceed to payment.', 200);
        } elseif ($lockedBy) {
            return $this->successResponse('Seat is locked by another user.', 409);
        }

        return $this->successResponse('Seat is available', 200);
    }


    public function unlockSeat(Request $request)
    {
        $lockKey = "seat_lock:{$request->event_id}:{$request->seat_number}";


        if (Redis::get($lockKey) == $request->user_id) {
            Redis::del($lockKey);
            return $this->successResponse('Seat is available Seat unlocked', 200);

        }

        return $this->successResponse('You cannot unlock this seat', 200);
    }
}
