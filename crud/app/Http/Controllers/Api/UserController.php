<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Service\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $service;

    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = User::all();
        return response()->json($result, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        return $this->service->storeUser($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->service->findUser($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['message' => 'User not found'], 404);
        } else {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);
            return $this->service->updateUser($data, $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user){
            $user = User::destroy($id);
            return response()->json(['message' => 'User deleted'], 200);
        } else{
            return response()->json(['message' => 'User not exist'], 404);
        }
    }
}
