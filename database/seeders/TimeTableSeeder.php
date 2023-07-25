<?php

namespace Database\Seeders;

use App\Models\Times;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Times::create([
            'time' => '08:00:00',
        ]);
        Times::create([
            'time' => '12:00:00',
        ]);
        Times::create([
            'time' => '15:00:00',
        ]);
    }
}
