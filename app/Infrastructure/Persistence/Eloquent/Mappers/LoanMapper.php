<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Eloquent\Mappers;

use App\Domain\Loan\Entities\Loan;
use App\Infrastructure\Persistence\Eloquent\Models\LoanModel;

final class LoanMapper
{
    public static function toExistingModel(Loan $entity, LoanModel $model): LoanModel
    {
        $model->id = $entity->id();
        $model->client_id = $entity->client()->id();
        $model->name = $entity->name();
        $model->amount_usd = $entity->amountUsd();
        $model->period_days = $entity->periodDays();
        $model->interest_rate = $entity->interestRate();
        $model->start_date = $entity->startDate();
        $model->end_date = $entity->endDate();

        return $model;
    }

    public static function toNewModel(Loan $entity): LoanModel
    {
        return self::toExistingModel($entity, new LoanModel);
    }
}
