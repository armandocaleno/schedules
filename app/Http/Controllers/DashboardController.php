<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index(){
        $users = User::count();
        $employees = Employee::count();
        $schedules = Schedule::count();

        return view('dashboard', compact('users', 'employees', 'schedules'));
    }
}
