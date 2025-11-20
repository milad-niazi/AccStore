<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiController
{
    protected $userRepo;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userRepo->all();
        return $this->successResponse(UserResource::collection($users), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->successResponse(new UserResource($this->userRepo->find($user)), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
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
            $data = $request->only('name', 'email', 'password');

            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $user = $this->userRepo->update($user, $data);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
        return $this->successResponse(new UserResource($user), 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->userRepo->delete($user);
        return $this->successResponse('User Deleted!', 200);
    }
}
