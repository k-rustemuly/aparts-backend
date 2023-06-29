<?php

declare(strict_types=1);

namespace Buildit\Enum;

enum RequestType: string
{
    case GET = 'get';
    case POST = 'post';
    case PUT = 'put';
    case PATCH = 'patch';
    case DELETE = 'delete';
}
