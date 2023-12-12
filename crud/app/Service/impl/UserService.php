<?php

namespace App\Service\impl;

use App\Repository\UserRepositoryInterface;
use App\Service\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function allUser()
    {
        return $this->repository->allUser();
    }

    public function storeUser($data)
    {
        return $this->repository->storeUser($data);
    }

    public function findUser($id)
    {
        return $this->repository->findUser($id);
    }

    public function updateUser($data, $id)
    {
        return $this->repository->updateUser($data,$id);
    }

    public function destroyUser($id)
    {
        $this->repository->destroyUser($id);
    }

    public function register($request)
    {
        return $this->repository->register($request);
    }

    public function login($request)
    {
        return $this->repository->login($request);
    }
}
