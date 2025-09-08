<?php

declare(strict_types=1);

namespace App\Application\UseCases;

use App\Application\DTO\ClientInformation;
use App\Application\DTO\CreateClientCommand;
use App\Domain\Client\Entities\Client;
use App\Domain\Client\Enums\Region;
use App\Domain\Client\Exceptions\ClientAlreadyExistsException;
use App\Domain\Client\Repositories\ClientRepository;
use App\Domain\Client\ValueObjects\EmailAddress;
use App\Domain\Client\ValueObjects\PersonalIdentificationNumber;
use App\Domain\Client\ValueObjects\PhoneNumber;
use App\Domain\Common\Services\IdGenerator;
use Carbon\Carbon;

final readonly class CreateClientHandler
{
    public function __construct(
        private ClientRepository $repository,
        private IdGenerator $idGenerator,
    ) {}

    public function execute(CreateClientCommand $cmd): ClientInformation
    {
        $client = new Client(
            id: $this->idGenerator->generate(),
            pin: new PersonalIdentificationNumber($cmd->pin),
            fullName: $cmd->fullName,
            birthDate: Carbon::make($cmd->birthDate),
            region: Region::from($cmd->region),
            city: $cmd->city,
            phone: new PhoneNumber($cmd->phone),
            email: new EmailAddress($cmd->email),
            creditScore: $cmd->creditScore,
            monthlyIncomeUsd: $cmd->monthlyIncomeUsd,
        );

        $this->ensureClientDoesntExists($client);

        $this->repository->create($client);

        return ClientInformation::fromEntity($client);
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
