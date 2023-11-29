<?php

namespace App\Service;

interface CommentServiceInterface
{
    public function allComment();
    public function storeComment($data);
    public function findComment($id);
    public function updateComment($data, $id);
    public function destroyComment($id);
}
