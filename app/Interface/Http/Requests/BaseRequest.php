<?php

declare(strict_types=1);

namespace App\Interface\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    abstract public function rules(): array;
}
