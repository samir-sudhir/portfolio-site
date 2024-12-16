<?php

namespace Database\Seeders;

use App\Models\Stat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stat::create([
            'projects_delivered' => 0,
            'supported_countries' => 0,
            'active_clients' => 0,
        ]);
    }
}
