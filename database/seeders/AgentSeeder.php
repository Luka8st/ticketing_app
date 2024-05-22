<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $dep = \App\Models\Department::inRandomOrder()->first();
            \App\Models\Agent::factory()->for($dep)->create([
                'first_name' => fake()->firstName,
                'last_name' => fake()->lastName
            ]);
        }
    }
}
