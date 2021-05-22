<?php declare(strict_types=1);

namespace VitesseCms\Log\Listeners;

use Phalcon\Events\Manager;
use VitesseCms\Log\Controllers\AdminlogController;

class InitiateAdminListeners
{
    public static function setListeners(Manager $eventsManager): void
    {
        $eventsManager->attach('adminMenu', new AdminMenuListener());
        $eventsManager->attach(AdminlogController::class, new AdminlogControllerListener());
    }
}
