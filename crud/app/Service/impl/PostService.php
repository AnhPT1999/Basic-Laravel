<?php

namespace App\Service\impl;

use App\Repository\PostRepositoryInterface;
use App\Service\PostServiceInterface;

class PostService implements PostServiceInterface
{
    private $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function allPost($status)
    {
        return $this->repository->allPost($status);
    }

    public function storePost($data)
    {
        return $this->repository->storePost($data);
    }

    public function findPost($id)
    {
        return $this->repository->findPost($id);
    }

    public function updatePost($data, $id)
    {
        return $this->repository->updatePost($data,$id);
    }

    public function destroyPost($id)
    {
        return $this->repository->destroyPost($id);
    }
}
