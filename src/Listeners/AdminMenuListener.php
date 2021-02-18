<?php declare(strict_types=1);

namespace VitesseCms\Log\Listeners;

use Phalcon\Events\Event;
use VitesseCms\Admin\Models\AdminMenu;
use VitesseCms\Admin\Models\AdminMenuNavBarChildren;

class AdminMenuListener
{
    public function AddChildren(Event $event, AdminMenu $adminMenu): void
    {
        if ($adminMenu->getUser()->getPermissionRole() === 'superadmin') :
            $children = new AdminMenuNavBarChildren();
            $children->addChild('Activity log', 'admin/log/adminlog/adminList');
            $adminMenu->addDropdown('System',$children);
        endif;
    }
}
