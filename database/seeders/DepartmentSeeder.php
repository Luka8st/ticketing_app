<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 3; $i++) {
            $dep = \App\Models\Department::factory()->create([
                'name' => fake()->randomElement(['Human Resources', 'Finance', 'Marketing', 'Sales', 'IT', 'Customer Service']),
            ]);
        }
    }
}
