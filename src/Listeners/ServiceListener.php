<?php declare(strict_types=1);

namespace VitesseCms\Log\Listeners;

use Phalcon\Events\Event;
use VitesseCms\Log\Services\LogService;

class ServiceListener
{
    public function __construct(private readonly LogService $logService)
    {
    }

    public function attach( Event $event): LogService
    {
        return $this->logService;
    }
}
