<?php declare(strict_types=1);

namespace VitesseCms\Log\Controllers;

use VitesseCms\Admin\Interfaces\AdminModelListInterface;
use VitesseCms\Admin\Interfaces\AdminModelReadOnlyInterface;
use VitesseCms\Admin\Traits\TraitAdminModelList;
use VitesseCms\Admin\Traits\TraitAdminModelReadOnly;
use VitesseCms\Content\Enum\ItemEnum;
use VitesseCms\Content\Repositories\ItemRepository;
use VitesseCms\Core\AbstractControllerAdmin;
use VitesseCms\Database\AbstractCollection;
use VitesseCms\Database\Models\FindOrder;
use VitesseCms\Database\Models\FindOrderIterator;
use VitesseCms\Database\Models\FindValueIterator;
use VitesseCms\Log\Enums\LogEnum;
use VitesseCms\Log\Repositories\LogRepository;
use VitesseCms\User\Enum\UserEnum;
use VitesseCms\User\Repositories\UserRepository;

class AdminlogController extends AbstractControllerAdmin implements
    AdminModelListInterface,
    AdminModelReadOnlyInterface
{
    use TraitAdminModelList;
    use TraitAdminModelReadOnly;

    private readonly LogRepository $logRepository;
    private readonly UserRepository $userRepository;

    public function OnConstruct()
    {
        parent::OnConstruct();

        $this->logRepository = $this->eventsManager->fire(LogEnum::GET_REPOSITORY->value, new \stdClass());
        $this->userRepository = $this->eventsManager->fire(UserEnum::GET_REPOSITORY->value, new \stdClass());
    }

    public function getModelList( ?FindValueIterator $findValueIterator): \ArrayIterator
    {
        return $this->logRepository->findAll(
            $findValueIterator,
            false,
            99999,
            new FindOrderIterator([new FindOrder('createdAt', -1)])
        );
    }

    public function getModel(string $id): ?AbstractCollection{
        return $this->logRepository->getById($id, false);
    }
    /*public function onConstruct()
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
    }*/
}
