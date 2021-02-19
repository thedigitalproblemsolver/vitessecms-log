<?php declare(strict_types=1);

namespace VitesseCms\Log;

use Phalcon\DiInterface;
use VitesseCms\Admin\Utils\AdminUtil;
use VitesseCms\Core\AbstractModule;
use VitesseCms\Log\Repositories\AdminRepositoryCollection;
use VitesseCms\User\Repositories\UserRepository;

class Module extends AbstractModule
{
    public function registerServices(DiInterface $di, string $string = null)
    {
        parent::registerServices($di, 'Log');

        if (AdminUtil::isAdminPage()):
            $di->setShared('repositories', new AdminRepositoryCollection(
                new UserRepository()
            ));
        endif;
    }
}