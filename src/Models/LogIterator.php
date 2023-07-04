<?php declare(strict_types=1);

namespace VitesseCms\Log\Models;

class LogIterator extends \ArrayIterator
{
    public function __construct(array $logs)
    {
        parent::__construct($logs);
    }

    public function current(): Log
    {
        return parent::current();
    }
}