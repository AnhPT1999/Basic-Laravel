<?php

namespace App\Repository\impl;

use App\Models\User;
use App\Notifications\TestNotification;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserRepository implements UserRepositoryInterface
{

    public function allUser()
    {
        return User::all();
    }

    public function storeUser($data)
    {
        return User::create($data);
    }

    public function findUser($id)
    {
        return User::find($id);
    }

    public function updateUser($data, $id)
    {
        $u = User::find($id);
        $u->name = $data['name'];
        $u->email = $data['email'];
        $u->password = $data['password'];
        $u->save();
        return $u;
    }

    public function destroyUser($id)
    {
        $u = $this->findUser($id);
        $u->delete();
    }

    public function register($request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required',
                ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function login($request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            $message['2'] = "Hi {$user->name}";
            $message['3'] = "login successful";

            $user->notify(new TestNotification($message));

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
