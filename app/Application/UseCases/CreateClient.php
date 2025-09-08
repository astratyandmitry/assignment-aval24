<?php

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
            fullName: $dto->fullName,
            birthDate: Carbon::make($dto->birthDate),
            region: Region::from($dto->region),
            city: $dto->city,
            phone: new PhoneNumber($dto->phone),
            email: new EmailAddress($dto->email),
            creditScore: $dto->creditScore,
            monthlyIncomeUsd: $dto->monthlyIncomeUsd,
        );

        $this->ensureClientDoesntExists($client);

        return $this->repository->create($client);
    }

    private function ensureClientDoesntExists(Client $client): void
    {
        if ($this->repository->existsByPin($client->pin())) {
            throw new ClientAlreadyExistsException('Client PIN is already taken.');
        }

        if ($this->repository->existsByPhone($client->phone())) {
            throw new ClientAlreadyExistsException('Client Phone number is already taken.');
        }

        if ($this->repository->existsByEmail($client->email())) {
            throw new ClientAlreadyExistsException('Client Email address is already taken.');
        }
    }
}
