<?php

namespace App\Domain\Common\Services;

interface IdGenerator
{
    public function generate(): string;
}
