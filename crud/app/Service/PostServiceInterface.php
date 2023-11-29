<?php

namespace App\Service;

interface PostServiceInterface
{
    public function allPost($status);
    public function storePost($data);
    public function findPost($id);
    public function updatePost($data, $id);
    public function destroyPost($id);

}
