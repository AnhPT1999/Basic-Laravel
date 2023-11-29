<?php

namespace App\Service\impl;

use App\Repository\CommentRepositoryInterface;
use App\Service\CommentServiceInterface;

class CommentService implements CommentServiceInterface
{

    private $service;

    public function __construct(CommentRepositoryInterface $service)
    {
        $this->service = $service;
    }
    public function allComment()
    {
        return $this->service->allComment();
    }

    public function storeComment($data)
    {
        return $this->service->storeComment($data);
    }

    public function findComment($id)
    {
        return $this->service->findComment($id);
    }

    public function updateComment($data, $id)
    {
        return $this->service->updateComment($data,$id);
    }

    public function destroyComment($id)
    {
        return $this->service->destroyComment($id);
    }
}
