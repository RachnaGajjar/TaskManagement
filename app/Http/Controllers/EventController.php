<?php

namespace App\Http\Controllers;

use App\Events\SendMail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class EventController extends Controller
{
    //
    public function index()
    {
       dd(Event::dispatch(new SendMail(1)));
    	dd('hi');
    }
}
