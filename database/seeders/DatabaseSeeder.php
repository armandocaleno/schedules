<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Armando Caleño',
            'email' => 'armandoc8181@gmail.com',
            'password' => bcrypt('admin.1234'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Luis Cuesta',
            'email' => 'lcuesta001@gmail.com',
            'password' => bcrypt('admin.1234'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $this->call(PositionSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(PeriodSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(RecessSeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(ShiftSeeder::class);
    }
}
