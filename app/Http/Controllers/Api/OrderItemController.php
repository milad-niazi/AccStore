<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\OrderItemResource;
use App\Repositories\OrderItemRepository;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends ApiController
{
    protected $orderItemRepo;

    public function __construct(OrderItemRepository $orderItemRepo)
    {
        $this->orderItemRepo = $orderItemRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderItems = $this->orderItemRepo->all();
        return $this->successResponse(OrderItemResource::collection($orderItems), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id'   => 'required|exists:orders,id',
            'account_id' => 'required|exists:accounts,id',
            'price'      => 'required|numeric|min:0',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }
        try {
            $orderItem = $this->orderItemRepo->create($request->only(['order_id', 'account_id', 'price']));
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 422);
        }
        return $this->successResponse(new OrderItemResource($orderItem), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = $this->orderItemRepo->findById($id);
        return $this->successResponse(new OrderItemResource($item), 200);;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        $validator = Validator::make($request->all(), [
            'order_id'   => 'sometimes|exists:orders,id',
            'account_id' => 'sometimes|exists:accounts,id',
            'price'      => 'sometimes|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        try {
            $data = $request->only(['order_id', 'account_id', 'price']);
            $orderItem = $this->orderItemRepo->update($orderItem, $data);
        } catch (\Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 422);
        }

        return $this->successResponse(new OrderItemResource($orderItem), 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $orderItem)
    {
        $this->orderItemRepo->delete($orderItem);
        return $this->successResponse('OrderItem Deleted!', 200);;
    }
}
