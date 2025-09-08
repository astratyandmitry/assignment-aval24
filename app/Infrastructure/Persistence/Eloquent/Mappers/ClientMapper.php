<?php

namespace App\Infrastructure\Persistence\Eloquent\Mappers;

use App\Domain\Client\Entities\Client;
use App\Domain\Client\ValueObjects\EmailAddress;
use App\Domain\Client\ValueObjects\PersonalIdentificationNumber;
use App\Domain\Client\ValueObjects\PhoneNumber;
use App\Infrastructure\Persistence\Eloquent\Models\ClientModel;

final class ClientMapper
{
    public static function toModel(Client $entity): ClientModel
    {
        $model = new ClientModel;
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

    public static function toEntity(ClientModel $model): Client
    {
        return new Client(
            id: $model->id,
            pin: new PersonalIdentificationNumber($model->pin),
            fullName: $model->full_name,
            birthDate: $model->birth_date,
            region: $model->location_region,
            city: $model->location_city,
            phone: new PhoneNumber($model->contact_phone),
            email: new EmailAddress($model->contact_email),
            creditScore: $model->credit_score,
            monthlyIncomeUsd: $model->monthly_income_usd,
        );
    }
}
