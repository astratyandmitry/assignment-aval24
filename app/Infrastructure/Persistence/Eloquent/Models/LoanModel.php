<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

/**
 * @property int $client_id
 * @property string $status
 * @property string $name
 * @property float $amount_usd
 * @property float $interest_rate
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 * @property \App\Infrastructure\Persistence\Eloquent\Models\ClientModel $client
 */
final class LoanModel extends BaseModel
{
    protected $table = 'loans';

    protected function casts(): array
    {
        return [
            'client_id' => 'integer',
            'status' => 'enum', // todo
            'amount_usd' => 'float',
            'interest_rate' => 'float',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }
}
