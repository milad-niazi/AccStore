<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\AccountResource;
use App\Repositories\AccountRepository;
use Illuminate\Support\Facades\Validator;

class AccountController extends ApiController
{
    protected $accountRepo;
    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepo = $accountRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = $this->accountRepo->all();
        return $this->successResponse(AccountResource::collection($accounts), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'username'    => 'required|string|max:255',
            'password'    => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'status' => 'required|in:available,sold',
            'sold_to'     => 'nullable|exists:users,id',
            'sold_at'     => 'nullable|date',
            'expires_at'  => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        try {
            $account = $this->accountRepo->create($request->only([
                'category_id',
                'title',
                'username',
                'password',
                'price',
                'status',
                'sold_to',
                'sold_at',
                'expires_at',
                'description',
            ]));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
        return $this->successResponse(new AccountResource($account), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($account)
    {
        return $this->successResponse(new AccountResource($this->accountRepo->find($account)), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $account)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'username'    => 'required|string|max:255',
            'password'    => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'status'      => 'required|in:available,sold',
            'sold_to'     => 'nullable|exists:users,id',
            'sold_at'     => 'nullable|date',
            'expires_at'  => 'nullable|date',
            'description' => 'nullable|string',
        ]);
        if ($request->status === 'sold') {
            $validator->after(function ($validator) use ($request) {
                if (!$request->sold_to) {
                    $validator->errors()->add('sold_to', 'The sold_to field is required when status is sold.');
                }
                if (!$request->sold_at) {
                    $validator->errors()->add('sold_at', 'The sold_at field is required when status is sold.');
                }
            });
        }
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        try {
            $account = $this->accountRepo->update($account, $request->only([
                'category_id',
                'title',
                'username',
                'password',
                'price',
                'status',
                'sold_to',
                'sold_at',
                'expires_at',
                'description',
            ]));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }
        return $this->successResponse(new AccountResource($account), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($account)
    {
        $this->accountRepo->delete($account);
        return $this->successResponse('Account Deleted!', 200);
    }
}
