<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use App\Domain\Client\Enums\Region;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $pin
 * @property string $full_name
 * @property string $location_city
 * @property string $contact_phone
 * @property string $contact_email
 * @property int $credit_score
 * @property float $monthly_income_usd
 * @property \Carbon\Carbon $birth_date
 * @property \App\Domain\Client\Enums\Region|string $location_region
 * @property \App\Infrastructure\Persistence\Eloquent\Models\LoanModel[]|\Illuminate\Database\Eloquent\Collection $loans
 */
final class ClientModel extends BaseModel
{
    protected $table = 'clients';

    protected function casts(): array
    {
        return [
            'location_region' => Region::class,
            'credit_score' => 'integer',
            'monthly_income_usd' => 'float',
            'birth_date' => 'date',
        ];
    }

    public function loans(): HasMany
    {
        return $this->hasMany(LoanModel::class);
    }
}
