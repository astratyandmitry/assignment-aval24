<?php

declare(strict_types=1);

namespace App\Domain\Client\Exceptions;

use DomainException;

final class ClientAlreadyExistsException extends DomainException {}
