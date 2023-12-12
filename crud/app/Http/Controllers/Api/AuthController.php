<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\UserServiceInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $service;

    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    public function register(Request $request)
    {
        return $this->service->register($request);
    }

    public function login(Request $request)
    {
        return $this->service->login($request);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message'=>'Logout']);
    }

}
