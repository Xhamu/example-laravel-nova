<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profession::factory()
            ->count(10)
            ->create();
    }
}
