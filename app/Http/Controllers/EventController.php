<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Traits\ApiResponse;
use App\Models\EventDetails;
use Illuminate\Http\Request;
use App\Http\Resources\EventResourceCollection;
use App\Http\Resources\EventDetailsResourceCollection;

class EventController extends Controller
{
    use ApiResponse;

    public function index(){

        $events = Event::paginate(10);

        $datas = new EventResourceCollection($events);

        return $this->successResponse('Event Fetched successfully!!',200,$datas);

    }


    public function details(){

        $events = EventDetails::paginate(10);

        $datas = new EventDetailsResourceCollection($events);

        return $this->successResponse('Event Details Fetched successfully!!',200,$datas);

    }
}
