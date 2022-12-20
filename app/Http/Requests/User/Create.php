<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Password as PasswordRules;

class Create extends BaseRequest
{
    /**
     * @return string
     */
    public function dto(): string
    {
        return Create::class;
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
