<?php declare(strict_types=1);

namespace VitesseCms\Log\Listeners\Controllers;

use Phalcon\Events\Event;
use VitesseCms\Admin\AbstractAdminController;
use VitesseCms\Admin\Forms\AdminlistFormInterface;
use VitesseCms\Log\Controllers\AdminlogController;
use VitesseCms\Log\Models\Log;

class AdminlogControllerListener
{
    public function adminListFilter(Event $event, AdminlogController $controller, AdminlistFormInterface $form): void
    {
        $form->addText('itemId', 'filter[itemId]')
            ->addText('userId', 'filter[userId]')
            ->addText('ipAddress', 'filter[ipAddress]')
            ->addText('property', 'filter[property]')
            ->addText('sourceUri', 'filter[sourceUri]')
        ;
    }

    public function beforeEdit(Event $event, AdminlogController $controller, Log $log): void
    {
        if($log->hasClass()):
            $class = $log->getClass();
            if (class_exists($class)):
                $controller->addRenderParam('item', $class::findById((string)$log->getItemId()));
            endif;
        endif;

        if ($log->getUserId() !== null) :
            $controller->addRenderParam(
                'user',
                $controller->repositories->user->getById((string)$log->getUserId())
            );
        endif;
    }
}
