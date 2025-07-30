<?php

namespace Database\Seeders;

use App\Models\FootballMatch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FootballMatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FootballMatch::factory(10)->create();
    }
}
