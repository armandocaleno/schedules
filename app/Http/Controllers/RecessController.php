<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecessController extends Controller
{
    function index(){
        return view('recesses.index');
    }
}
