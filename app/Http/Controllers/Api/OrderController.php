<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Repositories\OrderRepository;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;

class OrderController extends ApiController
{
    protected $orderRepo;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->successResponse(OrderResource::collection($this->orderRepo->all()), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'        => 'required|exists:users,id',
            'price'          => 'required|numeric|min:0',
            'status'         => 'required|in:pending,paid,failed',
            'payment_method' => 'nullable|in:zarinpal,idpay,wallet',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        try {
            $order = $this->orderRepo->create($request->only(['user_id', 'price', 'status', 'payment_method']));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 422);
        }
        return $this->successResponse(new OrderResource($order), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['orderItems', 'orderItems.account', 'buyer']);

        return new OrderResource($order);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request->all(), [
            'price'          => 'required|numeric|min:0',
            'status'         => 'required|in:pending,paid,failed',
            'payment_method' => 'nullable|in:zarinpal,idpay,wallet',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        $data = $request->only(['price', 'status', 'payment_method']);

        try {
            // آپدیت از طریق Repository
            $order = $this->orderRepo->update($order, $data);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 500);
        }

        return $this->successResponse(new OrderResource($order), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $this->orderRepo->delete($order);
        return $this->successResponse('Order Deleted!', 200);
    }
}
