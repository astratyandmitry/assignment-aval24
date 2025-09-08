<?php

namespace App\Infrastructure\Persistence\Eloquent\Mappers;

use App\Domain\Client\Entities\Client as Entity;
use App\Infrastructure\Persistence\Eloquent\Models\ClientModel;

final class ClientMapper
{
    public static function toModel(Entity $entity, ?ClientModel $model = null): ClientModel
    {
        $model ??= new ClientModel;
        $model->id = $entity->id();
        $model->full_name = $entity->full_name();
        $model->birth_date = $entity->birth_date();
        $model->location_region = $entity->region()->value;
        $model->location_city = $entity->city();
        $model->credit_score = $entity->credit_score();
        $model->monthly_income_usd = $entity->monthly_income_usd();
        $model->pin = (string) $entity->pin();
        $model->contact_email = (string) $entity->email();
        $model->contact_phone = (string) $entity->phone();

        return $model;
    }
}
