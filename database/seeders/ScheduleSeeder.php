<?php

namespace Database\Seeders;

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
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        foreach ($days as $day) {
            if ($day === 'Sunday') {
                // ปิดวันอาทิตย์
                Schedule::create([
                    'day_of_week' => $day,
                    'start_time' => '00:00',
                    'end_time' => '00:00',
                    'is_open' => false,
                ]);
            } else {
                Schedule::create([
                    'day_of_week' => $day,
                    'start_time' => '09:00',
                    'end_time' => '18:00',
                    'is_open' => true,
                ]);
            }
        }
    }
}   