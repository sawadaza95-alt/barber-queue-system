<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'ตัดผมสั้น',
            'description' => 'ตัดผมแบบสั้นทั่วไป',
            'duration' => 30,
            'price' => 100,
        ]);

        Service::create([
            'name' => 'ตัดผมยาว',
            'description' => 'ตัดผมแบบยาว ระดับไหล่',
            'duration' => 45,
            'price' => 150,
        ]);

        Service::create([
            'name' => 'ตัดผม + เซ็ต',
            'description' => 'ตัดผม พร้อมเซ็ตทรงผม',
            'duration' => 60,
            'price' => 200,
        ]);

        Service::create([
            'name' => 'ซัดหนวด',
            'description' => 'ซัดหนวดให้เรียบร้อย',
            'duration' => 15,
            'price' => 50,
        ]);

        Service::create([
            'name' => 'ตัดผม + ซัดหนวด',
            'description' => 'ตัดผมและซัดหนวดรวม',
            'duration' => 45,
            'price' => 150,
        ]);
    }
}