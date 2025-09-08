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
        $model->id = $entity->getId();
        $model->client_id = $entity->getClient()->getId();
        $model->name = $entity->getName();
        $model->amount_usd = $entity->getAmountUsd();
        $model->period_days = $entity->getPeriodDays();
        $model->interest_rate = $entity->getInterestRate();
        $model->start_date = $entity->getStartDate();
        $model->end_date = $entity->getEndDate();

        return $model;
    }
}
