<?php
declare(strict_types=1);

namespace VitesseCms\Log\Controllers;

use ArrayIterator;
use stdClass;
use VitesseCms\Admin\Interfaces\AdminModelListInterface;
use VitesseCms\Admin\Interfaces\AdminModelReadOnlyInterface;
use VitesseCms\Admin\Traits\TraitAdminModelList;
use VitesseCms\Admin\Traits\TraitAdminModelReadOnly;
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

        $this->logRepository = $this->eventsManager->fire(LogEnum::GET_REPOSITORY->value, new stdClass());
        $this->userRepository = $this->eventsManager->fire(UserEnum::GET_REPOSITORY->value, new stdClass());
    }

    public function getModelList(?FindValueIterator $findValueIterator): ArrayIterator
    {
        return $this->logRepository->findAll(
            $findValueIterator,
            false,
            9999,
            new FindOrderIterator([new FindOrder('createdAt', -1)])
        );
    }

    public function getModel(string $id): ?AbstractCollection
    {
        return $this->logRepository->getById($id, false);
    }
}
