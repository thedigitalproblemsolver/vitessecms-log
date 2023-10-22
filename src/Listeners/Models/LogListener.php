<?php declare(strict_types=1);

namespace VitesseCms\Log\Listeners\Models;

use VitesseCms\Log\Repositories\LogRepository;

class LogListener {
    public function __construct(private readonly LogRepository $logRepository)
    {
    }

    public function getRepository(): LogRepository
    {
        return $this->logRepository;
    }
}