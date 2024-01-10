<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShiftController extends Controller
{
    function index() {
        return view('shifts.index');
    }
}
