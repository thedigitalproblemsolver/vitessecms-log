<?php declare(strict_types=1);

namespace VitesseCms\Log\Enums;

enum LogEnum: string
{
    case LISTENER = 'logListener';
    case GET_REPOSITORY = 'logListener:getRepository';
}