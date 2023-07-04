<?php declare(strict_types=1);

namespace VitesseCms\Log\Listeners;

use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Log\Enums\LogEnum;
use VitesseCms\Log\Enums\LogServiceEnum;
use VitesseCms\Log\Listeners\Models\LogListener;
use VitesseCms\Log\Listeners\ServiceListener;
use VitesseCms\Log\Controllers\AdminlogController;
use VitesseCms\Log\Listeners\Admin\AdminMenuListener;
use VitesseCms\Log\Listeners\Controllers\AdminlogControllerListener;
use VitesseCms\Log\Repositories\LogRepository;

class InitiateAdminListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $di): void
    {
        $di->eventsManager->attach('adminMenu', new AdminMenuListener());
        $di->eventsManager->attach(LogServiceEnum::LISTENER->value, new ServiceListener($di->log));
        $di->eventsManager->attach(AdminlogController::class, new AdminlogControllerListener());
        $di->eventsManager->attach(LogEnum::LISTENER->value, new LogListener(new LogRepository()));
    }
}
