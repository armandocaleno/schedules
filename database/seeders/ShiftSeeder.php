<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Employee;
use App\Models\Recess;
use App\Models\Schedule;
use App\Models\Shift;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shift::create([
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'employee_id' => Employee::find(1)->id,
            'schedule_id' => Schedule::find(1)->id,
            'area_id' => Area::find(1)->id,
            'recess_id' => Recess::find(1)->id,
        ]);

        Shift::create([
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'employee_id' => Employee::find(2)->id,
            'schedule_id' => Schedule::find(2)->id,
            'area_id' => Area::find(2)->id,
            'recess_id' => Recess::find(2)->id,
        ]);

        Shift::create([
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'employee_id' => Employee::find(3)->id,
            'schedule_id' => Schedule::find(3)->id,
            'area_id' => Area::find(3)->id,
            'recess_id' => Recess::find(3)->id,
        ]);

        Shift::create([
            'date' => \Carbon\Carbon::now()->format('Y-m-d'),
            'employee_id' => Employee::find(4)->id,
            'schedule_id' => Schedule::find(1)->id
        ]);
    }
}
