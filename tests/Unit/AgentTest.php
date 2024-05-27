<?php

use App\Models\Department;
use App\Models\Ticket;
use App\Models\User;

it('has assigned tickets', function () {
    $dep = Department::factory()->create();
    $agent = User::factory()->for($dep, 'department')->create([
        'name' => 'Test Agent',
        'role' => 'agent'
    ]);
    $client = User::factory()->create();

    $ticket = Ticket::factory()->for($client, 'user')->for($agent, 'agent')->for($dep)->create([
        'title' => fake()->sentence,
        'description' => fake()->paragraph
    ]);

    expect($agent->ticketsForAgent)->toHaveCount(1);
});