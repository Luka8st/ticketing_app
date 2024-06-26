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

        $user = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(DepartmentSeeder::class);
        $this->call(TicketSeeder::class);

        // $this->call(AgentSeeder::class);
        for ($i = 0; $i < 10; $i++) {
            $dep = \App\Models\Department::inRandomOrder()->first();
            \App\Models\User::factory()->for($dep)->create([
                'name' => fake()->name,
                'role' => 'agent'
            ]);
        }
    }
}
