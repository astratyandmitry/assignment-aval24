<?php

declare(strict_types=1);

use App\Domain\Client\Enums\Region;
use App\Infrastructure\Persistence\Eloquent\Models\ClientModel;

test('it approve correct application', function (): void {
    $client = ClientModel::factory()->correct()->create([
        'location_region' => Region::BR->value,
    ]);

    $payload = [
        'client_id' => $client->id,
        'amount_usd' => fake()->numberBetween(500, 2000),
        'period_days' => fake()->numberBetween(30, 90),
    ];

    $this->postJson('/api/v1/loans/application', $payload)
        ->assertSuccessful()
        ->assertJsonStructure([
            'data' => [
                'clientId',
                'allowed',
                'denyReason',
                'interestRate',
                'amountUsd',
                'periodDays',
            ],
        ])
        ->assertJsonPath('data.amountUsd', $payload['amount_usd'])
        ->assertJsonPath('data.periodDays', $payload['period_days'])
        ->assertJsonPath('data.interestRate', 0.10)
        ->assertJsonPath('data.denyReason', null)
        ->assertJsonPath('data.allowed', true);
})->group('applications');

test('it increases interest rate for Ostrava application', function (): void {
    $client = ClientModel::factory()->correct()->create([
        'location_region' => Region::OS->value,
    ]);

    $payload = [
        'client_id' => $client->id,
        'amount_usd' => fake()->numberBetween(500, 2000),
        'period_days' => fake()->numberBetween(30, 90),
    ];

    $this->postJson('/api/v1/loans/application', $payload)
        ->assertSuccessful()
        ->assertJsonPath('data.interestRate', 0.15)
        ->assertJsonPath('data.allowed', true);
})->group('applications');

dataset('bad fields', [
    ['birth_date', '2010-01-01'],
    ['monthly_income_usd', 100],
    ['credit_score', 500],
]);

test('it decline application with bad :field', function (string $key, mixed $value): void {
    $client = ClientModel::factory()->correct()->create([
        $key => $value,
    ]);

    $payload = [
        'client_id' => $client->id,
        'amount_usd' => fake()->numberBetween(500, 2000),
        'period_days' => fake()->numberBetween(30, 90),
    ];

    $this->postJson('/api/v1/loans/application', $payload)
        ->assertSuccessful()
        ->assertJsonPath('data.allowed', false);
})->with('bad fields')->group('applications');
