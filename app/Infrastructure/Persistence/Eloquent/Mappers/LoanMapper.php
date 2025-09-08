<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Eloquent\Mappers;

use App\Domain\Loan\Entities\Loan;
use App\Infrastructure\Persistence\Eloquent\Models\LoanModel;

final class LoanMapper
{
    public static function toModel(Loan $entity): LoanModel
    {
        $model = new LoanModel;
        $model->id = $entity->id();
        $model->client_id = $entity->client()->id();
        $model->name = $entity->name();
        $model->amount_usd = $entity->amount_usd();
        $model->period_days = $entity->period_days();
        $model->interest_rate = $entity->interest_rate();
        $model->start_date = $entity->start_date();
        $model->end_date = $entity->end_date();

        return $model;
    }
}
