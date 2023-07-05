<?php declare(strict_types=1);

namespace VitesseCms\Log\Enums;

enum LogServiceEnum: string
{
    case LISTENER = 'logService';
    case ATTACH_SERVICE_LISTENER = 'logService:attach';
}