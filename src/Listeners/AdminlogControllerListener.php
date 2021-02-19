<?php declare(strict_types=1);

namespace VitesseCms\Log\Listeners;

use Phalcon\Events\Event;
use VitesseCms\Admin\AbstractAdminController;
use VitesseCms\Admin\Forms\AdminlistFormInterface;
use VitesseCms\Log\Controllers\AdminlogController;
use VitesseCms\Log\Models\Log;

class AdminlogControllerListener
{
    public function adminListFilter(
        Event $event,
        AbstractAdminController $controller,
        AdminlistFormInterface $form
    ): string
    {
        $form->addText('itemId', 'filter[itemId]')
            ->addText('userId', 'filter[userId]')
            ->addText('ipAddress', 'filter[ipAddress]')
            ->addText('property', 'filter[property]')
            ->addText('sourceUri', 'filter[sourceUri]');

        return $form->renderForm(
            $controller->getLink() . '/' . $controller->router->getActionName(),
            'adminFilter'
        );
    }

    public function beforeEdit(Event $event, AdminlogController $controller, Log $log): void
    {
        $class = $log->getClass();
        if (class_exists($class)):
            $controller->addRenderParam('item', $class::findById((string)$log->getItemId()));
        endif;

        if ($log->getUserId() !== null) :
            $controller->addRenderParam(
                'user',
                $controller->repositories->user->getById((string)$log->getUserId())
            );
        endif;
    }
}
