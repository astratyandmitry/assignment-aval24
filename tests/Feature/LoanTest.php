<?php

declare(strict_types=1);

use App\Domain\Client\Enums\Region;
use App\Infrastructure\Persistence\Eloquent\Models\ClientModel;

test('it issue a loan', function (): void {
    $client = ClientModel::factory()->correct()->create([
        'location_region' => Region::BR,
    ]);

    $payload = [
        'client_id' => $client->id,
        'amount_usd' => fake()->numberBetween(500, 2000),
        'period_days' => fake()->numberBetween(30, 90),
    ];

    $this->postJson('/api/v1/loans/issue', $payload)
        ->assertSuccessful()
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'amountUsd',
                'interestRate',
                'periodDays',
                'startDate',
                'endDate',
            ],
        ])
        ->assertJsonPath('data.interestRate', 0.10)
        ->assertJsonPath('data.startDate', now()->format('Y-m-d'))
        ->assertJsonPath('data.endDate', now()->addDays($payload['period_days'])->format('Y-m-d'));

    $this->assertDatabaseHas('loans', [
        'client_id' => $payload['client_id'],
    ]);
});
