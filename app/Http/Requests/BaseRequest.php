<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\DataTransferObject\DataTransferObject;

abstract class BaseRequest extends FormRequest
{
    /**
     * Return related dto namespace as string
     *
     * @return string
     */
    public abstract function dto(): string;

    /**
     * Validation rules lives here
     *
     * @return array
     */
    public abstract function rules(): array;

    public function dtoInstance(): DataTransferObject
    {
        return (new $this->dto())($this->all());
    }
}
