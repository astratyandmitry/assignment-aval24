<?php

declare(strict_types=1);

use App\Domain\Client\Enums\Region;
use App\Infrastructure\Persistence\Eloquent\Models\ClientModel;

test('it issue a loan', function(): void {
    $client = ClientModel::factory()->correct()->create([
        'location_region' => Region::BR,
    ]);

    $payload = [
        'client_id' => $client->id,
        'amount_usd' => fake()->numberBetween(500, 2000),
        'period_days' => fake()->numberBetween(30, 90),
    ];

    $this->postJson('/api/v1/loans', $payload)
        ->assertSuccessful()
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'amount_usd',
                'interest_rate',
                'period_days',
                'period' => ['start', 'end'],
                'client',
            ],
        ])
        ->assertJsonPath('data.interest_rate', 0.10)
        ->assertJsonPath('data.period.start', now()->format('Y-m-d'))
        ->assertJsonPath('data.period.end', now()->addDays($payload['period_days'])->format('Y-m-d'));

    $this->assertDatabaseHas('loans', [
        'client_id' => $payload['client_id'],
    ]);
});
