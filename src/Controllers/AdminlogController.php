<?php declare(strict_types=1);

namespace VitesseCms\Log\Controllers;

use VitesseCms\Admin\AbstractAdminController;
use VitesseCms\Database\AbstractCollection;
use VitesseCms\Form\AbstractForm;
use VitesseCms\Log\Models\Log;
use VitesseCms\Log\Repositories\AdminRepositoriesInterface;

class AdminlogController extends AbstractAdminController implements AdminRepositoriesInterface
{

    public function onConstruct()
    {
        parent::onConstruct();

        $this->listOrder = 'createdAt';
        $this->listOrderDirection = -1;
        $this->class = Log::class;
        $this->displayEditButton = false;
    }

    public function editAction(
        string $itemId = null,
        string $template = 'editForm',
        string $templatePath = 'core/src/Resources/views/admin/',
        AbstractForm $form = null
    ): void
    {
        parent::editAction(
            $itemId,
            'adminLogEdit',
            'log/src/Resources/views/admin/'
        );
    }

    protected function getAdminlistName(AbstractCollection $item): string
    {
        return $item->getCreateDate()->format('Y-m-d') . ' - ' . $item->_('message');
    }
}
