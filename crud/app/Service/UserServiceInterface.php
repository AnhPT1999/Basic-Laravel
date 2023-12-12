<?php

namespace App\Service;

interface UserServiceInterface
{
    public function allUser();
    public function storeUser($data);
    public function findUser($id);
    public function updateUser($data, $id);
    public function destroyUser($id);
    public function register($request);
    public function login($request);
}
