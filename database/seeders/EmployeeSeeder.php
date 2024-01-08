<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'name' => 'Luis',
            'lastname' => 'Cuesta',
            'id_number' => '0936463748',
            'position_id' => Position::first()->id
        ]);

        Employee::create([
            'name' => 'Fernando',
            'lastname' => 'Pilco',
            'id_number' => '0936498654',
            'position_id' => Position::first()->id
        ]);

        Employee::create([
            'name' => 'José',
            'lastname' => 'Serrano',
            'id_number' => '0936267740',
            'position_id' => Position::first()->id
        ]);

        Employee::create([
            'name' => 'Cristian',
            'lastname' => 'Macas',
            'id_number' => '0936409609',
            'position_id' => Position::first()->id
        ]);

        Employee::create([
            'name' => 'Melanie',
            'lastname' => 'Reyes',
            'id_number' => '0937773465',
            'position_id' => Position::first()->id
        ]);

        Employee::create([
            'name' => 'Oscar',
            'lastname' => 'Males',
            'id_number' => '0931275665',
            'position_id' => Position::first()->id
        ]);

        Employee::create([
            'name' => 'Hugo',
            'lastname' => 'Parada',
            'id_number' => '0938564987',
            'position_id' => Position::first()->id
        ]);
    }
}
