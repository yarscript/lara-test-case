<?php

namespace App\Dto\Create;

use App\Dto\BaseDto;

abstract class Create extends BaseDto
{
    public string $email;

    public string $name;

    public ?string $api_token;
}
