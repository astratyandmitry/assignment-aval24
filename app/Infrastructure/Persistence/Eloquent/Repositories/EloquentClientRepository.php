<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Client\Entities\Client;
use App\Domain\Client\Repositories\ClientRepository;
use App\Domain\Client\ValueObjects\EmailAddress;
use App\Domain\Client\ValueObjects\PersonalIdentificationNumber;
use App\Domain\Client\ValueObjects\PhoneNumber;
use App\Infrastructure\Persistence\Eloquent\Mappers\ClientMapper;
use App\Infrastructure\Persistence\Eloquent\Models\ClientModel;

final class EloquentClientRepository implements ClientRepository
{
    public function findById(string $id): ?Client
    {
        $model = ClientModel::query()->find($id);

        return $model ? ClientMapper::toEntity($model) : null;
    }

    public function create(Client $client): Client
    {
        ClientMapper::toModel($client)->save();

        return $client;
    }

    public function existsByPin(PersonalIdentificationNumber $pin): bool
    {
        return ClientModel::query()->where('pin', (string) $pin)->exists();
    }

    public function existsByEmail(EmailAddress $email): bool
    {
        return ClientModel::query()->where('contact_email', (string) $email)->exists();
    }

    public function existsByPhone(PhoneNumber $phone): bool
    {
        return ClientModel::query()->where('contact_phone', (string) $phone)->exists();
    }
}
