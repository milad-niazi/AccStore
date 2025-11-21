<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{
    protected $userRepo;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        try {
            $user = $this->userRepo->create($request->only('name', 'email', 'password'));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
        return $this->successResponse(new UserResource($user), 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        $user = $this->userRepo->findByEmail($request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->errorResponse('Worng Email Or Password!', 422);
        }
        $token = $user->createToken('api-token')->plainTextToken;

        return $this->successResponse([
            'user' => new UserResource($user),
            'token' => $token
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->successResponse('Logout Done!', 200);
    }
}
