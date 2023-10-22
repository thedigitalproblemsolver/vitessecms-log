<?php declare(strict_types=1);

namespace VitesseCms\Log\Enums;

enum LogEnum: string
{
    case LISTENER = 'LogListener';
    case GET_REPOSITORY = 'LogListener:getRepository';
}