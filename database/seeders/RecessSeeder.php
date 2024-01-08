<?php

namespace Database\Seeders;

use App\Models\Recess;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recess::create([
            'name' => 'día 1',
            'start' => '12:00:00',
            'end' => '13:00:00',
            'duration' => '60'
        ]);

        Recess::create([
            'name' => 'día 2',
            'start' => '13:00:00',
            'end' => '14:00:00',
            'duration' => '60'
        ]);

        Recess::create([
            'name' => 'noche',
            'start' => '17:00:00',
            'end' => '18:00:00',
            'duration' => '60'
        ]);
    }
}
