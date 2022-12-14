<?php

namespace App\Http\Requests\User;

use App\Dto\User\CreateData;
use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password as PasswordRules;
use Spatie\DataTransferObject\DataTransferObject;

class Create extends BaseRequest
{
    /**
     * @return string
     */
    public function dto(): string
    {
        return CreateData::class;
    }

    /**
     * Get validation rules that apply to the request
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => ['required', 'confirmed', PasswordRules::defaults()],
        ];
    }
}
