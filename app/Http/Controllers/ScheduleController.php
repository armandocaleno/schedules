<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    function index(){
        return view('schedules.index');
    }
}
