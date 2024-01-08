<?php

namespace Database\Seeders;

use App\Models\Period;
use App\Models\Recess;
use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedule1 = Schedule::create([
            'name' => 'diurno 1',
            'start' => '07:00:00',
            'end' => '16:00:00',
            'skip' => '0',
            'period_id' => Period::find(1)->id
        ]);
        $schedule1->recesses()->attach(Recess::find(1)->id);

        $schedule2 = Schedule::create([
            'name' => 'diurno 2',
            'start' => '08:00:00',
            'end' => '17:00:00',
            'skip' => '0',
            'period_id' => Period::find(1)->id
        ]);
        $schedule2->recesses()->attach(Recess::find(2)->id);

        $schedule3 = Schedule::create([
            'name' => 'nocturno 1',
            'start' => '17:00:00',
            'end' => '02:00:00',
            'skip' => '1',
            'period_id' => Period::find(2)->id
        ]);
        $schedule3->recesses()->attach(Recess::find(3)->id);

        Schedule::create([
            'name' => 'libre',
            'start' => '00:00:00',
            'end' => '00:00:00',
            'skip' => '0',
            'period_id' => Period::find(3)->id
        ]);
    }
}
