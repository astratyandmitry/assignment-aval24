<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Eloquent\Mappers;

use App\Domain\Client\Entities\Client;
use App\Domain\Client\Enums\Region;
use App\Domain\Client\ValueObjects\EmailAddress;
use App\Domain\Client\ValueObjects\PersonalIdentificationNumber;
use App\Domain\Client\ValueObjects\PhoneNumber;
use App\Infrastructure\Persistence\Eloquent\Models\ClientModel;

final class ClientMapper
{
    public static function toExistingModel(Client $entity, ClientModel $model): ClientModel
    {
        $model->id = $entity->id();
        $model->full_name = $entity->fullName();
        $model->birth_date = $entity->birthDate();
        $model->location_region = $entity->region()->value;
        $model->location_city = $entity->city();
        $model->credit_score = $entity->creditScore();
        $model->monthly_income_usd = $entity->monthlyIncomeUsd();
        $model->pin = (string) $entity->pin();
        $model->contact_email = (string) $entity->email();
        $model->contact_phone = (string) $entity->phone();

        return $model;
    }

    public static function toNewModel(Client $entity): ClientModel
    {
        return self::toExistingModel($entity, new ClientModel);
    }

    public static function toEntity(ClientModel $model): Client
    {
        return new Client(
            id: $model->id,
            pin: new PersonalIdentificationNumber($model->pin),
            fullName: $model->full_name,
            birthDate: $model->birth_date,
            region: Region::from($model->location_region),
            city: $model->location_city,
            phone: new PhoneNumber($model->contact_phone),
            email: new EmailAddress($model->contact_email),
            creditScore: $model->credit_score,
            monthlyIncomeUsd: $model->monthly_income_usd,
        );
    }
}
