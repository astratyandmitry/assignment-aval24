<?php

declare(strict_types=1);

use App\Domain\Client\Enums\Region;

function makeClientPayload(array $overrides = []): array
{
    return array_merge([
        'pin' => fake()->unique()->numerify('####-####'),
        'full_name' => fake()->name,
        'birth_date' => fake()->date('Y-m-d', '-25 years'),
        'region' => fake()->randomElement(Region::cases())->value,
        'city' => fake()->city,
        'phone' => fake()->unique()->numerify('+###########'),
        'email' => fake()->unique()->safeEmail,
        'credit_score' => fake()->numberBetween(300, 850),
        'monthly_income_usd' => fake()->numberBetween(500, 20000),
    ], $overrides);
}

dataset('unique fields', [
    'pin',
    'phone',
    'email',
]);

test('it can create a client', function (): void {
    $payload = makeClientPayload();

    $this->postJson('/api/v1/clients', $payload)
        ->assertSuccessful()
        ->assertJsonStructure([
            'data' => [
                'id',
                'pin',
                'fullName',
                'birthDate',
                'region',
                'city',
                'phone',
                'email',
                'creditScore',
                'monthlyIncomeUsd',
            ],
        ])
        ->assertJsonPath('data.pin', $payload['pin'])
        ->assertJsonPath('data.phone', $payload['phone'])
        ->assertJsonPath('data.email', $payload['email']);

    $this->assertDatabaseHas('clients', [
        'pin' => $payload['pin'],
        'contact_phone' => $payload['phone'],
        'contact_email' => $payload['email'],
    ]);
})->group('clients');

test('it cannot create a client with duplicated :field', function (string $field): void {
    $firstPayload = makeClientPayload();

    $this->postJson('/api/v1/clients', $firstPayload)->assertSuccessful();

    $secondPayload = makeClientPayload([
        $field => $firstPayload[$field],
    ]);

    $this->postJson('/api/v1/clients', $secondPayload)
        ->assertStatus(400)
        ->assertJsonMissingPath('data');

    $this->assertDatabaseCount('clients', 1);
})->with('unique fields')->group('clients');
