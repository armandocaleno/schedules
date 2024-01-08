<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PositionController extends Controller
{
    function index()
    {
        return view('positions.index');
    }
}
