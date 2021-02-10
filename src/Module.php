<?php declare(strict_types=1);

namespace VitesseCms\Log;

use Phalcon\DiInterface;
use VitesseCms\Core\AbstractModule;

class Module extends AbstractModule
{
    public function registerServices(DiInterface $di, string $string = null)
    {
        parent::registerServices($di, 'Log');
    }
}