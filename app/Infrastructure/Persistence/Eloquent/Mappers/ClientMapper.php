<?php

declare(strict_types=1);

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
        $model->id = $entity->getId();
        $model->full_name = $entity->getFullName();
        $model->birth_date = $entity->getBirthDate();
        $model->location_region = $entity->getRegion()->value;
        $model->location_city = $entity->getCity();
        $model->credit_score = $entity->getCreditScore();
        $model->monthly_income_usd = $entity->getMonthlyIncomeusd();
        $model->pin = (string) $entity->getPin();
        $model->contact_email = (string) $entity->getEmail();
        $model->contact_phone = (string) $entity->getPhone();

        return $model;
    }

    public static function toEntity(ClientModel $model): Client
    {
        return new Client(
            id: $model->id,
            pin: new PersonalIdentificationNumber($model->pin),
            full_name: $model->full_name,
            birth_date: $model->birth_date,
            region: $model->location_region,
            city: $model->location_city,
            phone: new PhoneNumber($model->contact_phone),
            email: new EmailAddress($model->contact_email),
            credit_score: $model->credit_score,
            monthly_income_usd: $model->monthly_income_usd,
        );
    }
}
