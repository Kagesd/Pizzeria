<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Http\Requests\OrderLocationRequest;
use App\Models\Cart;
use App\Models\Location;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class OrderService
{
    public function createOrder(int $userId, OrderLocationRequest $request)
    {
        DB::beginTransaction();
        try {
            $cart = Cart::where('user_id', $userId)
                ->with('cartItems.product')
                ->firstOrFail();

            if ($cart->cartItems->isEmpty()) {
                throw new \Exception('Cart is empty');
            }

            $order = Order::create([
                'user_id' => $userId,
                'cart_id' => $cart->id,
                'status' => OrderStatus::PROCESSING
            ]);

            foreach ($cart->cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price
                ]);
            }
            $data = $request->validated();
            Location::create([
                'address' => $data['address'],
                'city' => $data['city'],
                'country' => $data['country'],
                'order_id' => $order->id
            ]);

            $cart->cartItems()->delete();
            DB::commit();

            return $order;
        } catch (\Throwable $throwable) {
            DB::rollBack();
            Log::error('Order creation failed: ' . $throwable->getMessage());
            throw $throwable;
        }
    }

    public function getOrders(int $userId)
    {
        return Order::where('user_id', $userId)->with(['Location', 'orderItems.product'])->paginate(10);
    }

    public function getOrder(Order $order)
    {
        return $order->loadMissing('Location', 'orderItmes');
    }

    public function updateOrder(Order $order, OrderLocationRequest $request)
    {
        $data = $request->validated();
        $order->location->update([
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
        ]);

        return $order->fresh();
    }

    public function cancelOrder(Order $order): void
    {
        $order->update(['status' => OrderStatus::CANCELLED]);
    }
}