<?php declare(strict_types=1);

namespace VitesseCms\Log\Listeners;

use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Log\Controllers\AdminlogController;
use VitesseCms\Log\Listeners\Admin\AdminMenuListener;
use VitesseCms\Log\Listeners\Controllers\AdminlogControllerListener;

class InitiateAdminListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $di): void
    {
        $di->eventsManager->attach('adminMenu', new AdminMenuListener());
        $di->eventsManager->attach(AdminlogController::class, new AdminlogControllerListener());
    }
}
