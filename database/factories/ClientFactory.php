<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Client\Enums\Region;
use App\Infrastructure\Persistence\Eloquent\Models\ClientModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Infrastructure\Persistence\Eloquent\Models\ClientModel>
 */
final class ClientFactory extends Factory
{
    protected $model = ClientModel::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'pin' => $this->faker->unique()->numerify('####-####'),
            'full_name' => $this->faker->name,
            'birth_date' => $this->faker->date('Y-m-d', '-25 years'),
            'location_region' => $this->faker->randomElement(Region::cases())->value,
            'location_city' => $this->faker->city,
            'contact_phone' => $this->faker->unique()->numerify('+###########'),
            'contact_email' => $this->faker->unique()->safeEmail,
            'credit_score' => $this->faker->numberBetween(300, 850),
            'monthly_income_usd' => $this->faker->numberBetween(500, 20000),
        ];
    }

    public function correct(): static
    {
        return $this->state(fn(array $attributes): array => [
            'birth_date' => '2000-01-01',
            'monthly_income_usd' => 5000,
            'credit_score' => 1000,
        ]);
    }
}
