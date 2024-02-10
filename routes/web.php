<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // calendario
    Route::get('/calendario', [CalendarController::class, 'index'])->name('calendar');

    // cargos
    Route::get('/cargos', [PositionController::class, 'index'])->name('positions.index');

   // turnos
    Route::get('/turnos', [ShiftController::class, 'index'])->name('shifts.index');
  
  // areas
    Route::get('/areas', [AreaController::class, 'index'])->name('areas.index');
  
   // empleados
    Route::get('empleados/show/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('empleados/index', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/grafico1', [EmployeeController::class, 'grafico1'])->name('employees.grafico1');
});
