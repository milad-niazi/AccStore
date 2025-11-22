<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Resources\OrderItemResource;

class OrderItemController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $item)
    {
        $item->load(['account', 'order.buyer']);

        return new OrderItemResource($item);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
