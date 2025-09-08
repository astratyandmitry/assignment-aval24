<?php

declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Domain\Common\Services\IdGenerator;
use Illuminate\Support\Str;

final readonly class UuidGenerator implements IdGenerator
{
    public function generate(): string
    {
        return Str::uuid()->toString();
    }
}
