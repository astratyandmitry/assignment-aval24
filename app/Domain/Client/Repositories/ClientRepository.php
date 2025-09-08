<?php

namespace App\Domain\Client\Repositories;

use App\Domain\Client\Entities\Client;
use App\Domain\Client\ValueObjects\EmailAddress;
use App\Domain\Client\ValueObjects\PersonalIdentificationNumber;
use App\Domain\Client\ValueObjects\PhoneNumber;

interface ClientRepository
{
    public function create(Client $client): Client;

    public function existsByPin(PersonalIdentificationNumber $pin): bool;

    public function existsByEmail(EmailAddress $email): bool;

    public function existsByPhone(PhoneNumber $phone): bool;
}
