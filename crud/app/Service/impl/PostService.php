<?php

namespace App\Service\impl;

use App\Repository\PostRepositoryInterface;
use App\Service\PostServiceInterface;

class PostService implements PostServiceInterface
{
    private $service;

    public function __construct(PostRepositoryInterface $service)
    {
        $this->service = $service;
    }

    public function allPost($status)
    {
        return $this->service->allPost($status);
    }

    public function storePost($data)
    {
        return $this->service->storePost($data);
    }

    public function findPost($id)
    {
        return $this->service->findPost($id);
    }

    public function updatePost($data, $id)
    {
        return $this->service->updatePost($data,$id);
    }

    public function destroyPost($id)
    {
        return $this->service->destroyPost($id);
    }
}
