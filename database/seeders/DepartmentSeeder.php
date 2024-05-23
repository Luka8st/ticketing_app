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
        // for ($i = 0; $i < 3; $i++) {
        //     $dep = \App\Models\Department::factory()->create([
        //         'name' => fake()->randomElement(['Human Resources', 'Finance', 'Marketing', 'Sales', 'IT', 'Customer Service']),
        //     ]);
        // }

        $departments = ['Human Resources', 'Finance', 'Marketing', 'Sales', 'IT', 'Customer Service'];
        $created = 0;
        while ($created < 3) {
            $index = rand(0, count($departments));
            $dep = \App\Models\Department::factory()->create([
                'name' => $departments[$index]
            ]);
            array_splice($departments, $index, 1);

            $created++;
        }
    }
}
