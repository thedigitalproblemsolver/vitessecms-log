<?php
declare(strict_types=1);

namespace VitesseCms\Log\Models;

use ArrayIterator;

class LogIterator extends ArrayIterator
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