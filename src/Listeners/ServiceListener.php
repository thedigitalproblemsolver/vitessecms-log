<?php declare(strict_types=1);

namespace VitesseCms\Log\Listeners;

use Phalcon\Events\Event;
use VitesseCms\Log\Services\LogService;

class ServiceListener
{
    private LogService $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }

    public function attach( Event $event): LogService
    {
        return $this->logService;
    }
}
