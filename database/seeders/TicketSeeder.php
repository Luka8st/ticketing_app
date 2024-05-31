<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {
            $dep = \App\Models\Department::inRandomOrder()->first();
            $user = \App\Models\User::first();
            \App\Models\Ticket::factory()->for($user)->for($dep)->create([
                'title' => fake()->sentence,
                'description' => fake()->paragraph
            ]);
        }
    }
}
