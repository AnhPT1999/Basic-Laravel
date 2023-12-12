<?php

namespace App\Service\impl;

use App\Repository\CommentRepositoryInterface;
use App\Service\CommentServiceInterface;

class CommentService implements CommentServiceInterface
{

    private $repository;

    public function __construct(CommentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    public function allComment()
    {
        return $this->repository->allComment();
    }

    public function storeComment($data)
    {
        return $this->repository->storeComment($data);
    }

    public function findComment($id)
    {
        return $this->repository->findComment($id);
    }

    public function updateComment($data, $id)
    {
        return $this->repository->updateComment($data,$id);
    }

    public function destroyComment($id)
    {
        return $this->repository->destroyComment($id);
    }
}
