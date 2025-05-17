<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrderLocationRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }


    public function index()
    {
        $user = auth(guard: 'api')->user();
        $orders = $this->orderService->getOrders(userId: $user->id);

        return OrderResource::collection(resource: $orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderLocationRequest $request)
    {
        $user = auth('api')->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $order = $this->orderService->createOrder($user->id, $request);
            return response()->json([
                'message' => 'Order created successfully',
                'order' => new OrderResource($order)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        try {
            $order = $this->orderService->getOrder($order);
            return new OrderResource($order->loadMissing('location', 'orderItems'));
        } catch(\Throwable $throwable) {
            return response()->json([
                'message' => $throwable->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        try{
            $updatedOrder = $this->orderService->updateOrder($order, $request->validated());

            return response()->json(data: [
                'message' => 'Order updated',
                'order' => new OrderResource(resource: $updatedOrder),
            ], status: 200);
        } catch(\Exception $e) {
            Log::error('Order update failed: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        try {
            $this->orderService->cancelOrder($order);
            return response()->json(['message' => 'Order cancelled'], 200);
        } catch(ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Order not found'
            ]);
        } catch(\Exception $e) {
            Log::error("Order cancellation failed: " . $e->getMessage());
            return response()->json([
                'message' => 'Failed to cancel order',
            ], 500);
        }
    }
}
