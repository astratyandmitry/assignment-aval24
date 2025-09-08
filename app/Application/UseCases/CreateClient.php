<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Application\DTO\CreateClientDTO;
use App\Domain\Client\Entities\Client;
use App\Domain\Client\Enums\Region;
use App\Domain\Client\Exceptions\ClientAlreadyExistsException;
use App\Domain\Client\Repositories\ClientRepository;
use App\Domain\Client\ValueObjects\EmailAddress;
use App\Domain\Client\ValueObjects\PersonalIdentificationNumber;
use App\Domain\Client\ValueObjects\PhoneNumber;
use App\Domain\Common\Services\IdGenerator;
use Carbon\Carbon;

final readonly class CreateClient
{
    public function __construct(
        private ClientRepository $repository,
        private IdGenerator $idGenerator,
    ) {}

    public function execute(CreateClientDTO $dto): Client
    {
        $client = new Client(
            id: $this->idGenerator->generate(),
            pin: new PersonalIdentificationNumber($dto->pin),
            full_name: $dto->fullName,
            birth_date: Carbon::make($dto->birthDate),
            region: Region::from($dto->region),
            city: $dto->city,
            phone: new PhoneNumber($dto->phone),
            email: new EmailAddress($dto->email),
            credit_score: $dto->creditScore,
            monthly_income_usd: $dto->monthlyIncomeUsd,
        );

        $this->ensureClientDoesntExists($client);

        return $this->repository->create($client);
    }

    private function ensureClientDoesntExists(Client $client): void
    {
        if ($this->repository->existsByPin($client->getPin())) {
            throw new ClientAlreadyExistsException('Client PIN is already taken.');
        }

        if ($this->repository->existsByPhone($client->getPhone())) {
            throw new ClientAlreadyExistsException('Client Phone number is already taken.');
        }

        if ($this->repository->existsByEmail($client->getEmail())) {
            throw new ClientAlreadyExistsException('Client Email address is already taken.');
        }
    }
}
