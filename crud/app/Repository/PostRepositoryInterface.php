<?php

namespace App\Repository;

interface PostRepositoryInterface
{
    public function allPost($status);
    public function storePost($data);
    public function findPost($id);
    public function updatePost($data, $id);
    public function destroyPost($id);

}
