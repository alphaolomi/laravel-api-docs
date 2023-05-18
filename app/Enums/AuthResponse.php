<?php

declare(strict_types=1);

namespace App\Enums;

enum AuthResponse: int
{
    case SUCCESS = 0;
    case INVALID_ACCESS_TOKEN = 1;
    case INVALID_CREDENTIALS = 2;
    case UNAUTHORIZED = 3;
}
