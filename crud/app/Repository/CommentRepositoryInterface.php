<?php

namespace App\Repository;

interface CommentRepositoryInterface
{
    public function allComment();
    public function storeComment($data);
    public function findComment($id);
    public function updateComment($data, $id);
    public function destroyComment($id);
}
