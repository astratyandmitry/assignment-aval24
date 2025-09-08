<?php

declare(strict_types=1);

namespace App\Domain\Common\Services;

interface IdGenerator
{
    public function generate(): string;
}
