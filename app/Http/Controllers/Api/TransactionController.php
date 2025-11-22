<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\TransactionResource;
use Illuminate\Support\Facades\Validator;
use App\Repositories\TransactionRepository;

class TransactionController extends ApiController
{
    protected $transactionRepo;

    public function __construct(TransactionRepository $transactionRepo)
    {
        $this->transactionRepo = $transactionRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->successResponse($this->transactionRepo->all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id'        => 'required|exists:orders,id',
            'transaction_id'  => 'required|string|unique:transactions,transaction_id',
            'status'          => 'required|in:pending,paid,failed,canceled',
            'amount'          => 'required|numeric|min:0',
            'gateway'         => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        try {
            $transaction = $this->transactionRepo->create($request->only(['order_id', 'transaction_id', 'status', 'amount', 'gateway']));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 422);
        }
        return $this->successResponse(new TransactionResource($transaction), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaction = $this->transactionRepo->findById($id);

        $transaction->load([
            'order.orderItems.account'
        ]);

        return $this->successResponse(new TransactionResource($transaction), 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'order_id'        => 'sometimes|exists:orders,id',
            'transaction_id'  => 'sometimes|string|unique:transactions,transaction_id,' . $id,
            'status'          => 'sometimes|in:pending,paid,failed,canceled',
            'amount'          => 'sometimes|numeric|min:0',
            'gateway'         => 'sometimes|string|max:255',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        try {
            $transaction = $this->transactionRepo->update(
                $id,
                $request->only(['order_id', 'transaction_id', 'status', 'amount', 'gateway'])
            );
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 422);
        }
        return $this->successResponse(new TransactionResource($transaction), 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->transactionRepo->delete($id);
        return $this->successResponse('Transaction Deleted!', 200);
    }
}
