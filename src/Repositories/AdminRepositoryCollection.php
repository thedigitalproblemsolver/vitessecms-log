<?php declare(strict_types=1);

namespace VitesseCms\Log\Repositories;

use VitesseCms\Database\Interfaces\BaseRepositoriesInterface;
use VitesseCms\User\Repositories\UserRepository;

class AdminRepositoryCollection implements AdminRepositoriesInterface, BaseRepositoriesInterface
{
    /**
     * @var UserRepository
     */
    public $user;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->user = $userRepository;
    }
}
