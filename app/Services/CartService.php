<?php

namespace App\Services;


use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CartService
{
    public function getCart(int $userId)
    {
        return Cart::firstOrCreate(['user_id' => $userId]);
    }

    public function getCartItems(int $userId)
    {
        try{
            $cart = Cart::where('user_id', $userId)->with('cartItems')->first();
            return $cart ? $cart->cartItems : [];
        } catch(\Throwable $throwable) {
            Log::error("Failed to get cart items". [
                'error' => $throwable->getMessage()
            ]);
            return [];
        }
    }

     public function addItemToCart(array $validated, int $userId)
     {
        DB::beginTransaction();
        try{
            $product = Product::findOrFail($validated['product_id']);
            $cart = $this->getCart($userId);

            $cartItem = $cart->cartItems()->updateOrCreate(
                ['product_id' => $validated['product_id']],
                [
                    'quantity' => $validated['quantity'],
                    'price' => $product->price
                ]
            );
            DB::commit();
            return $cartItem;
        } catch(\Throwable $throwable) {
            DB::rollback();
            throw $throwable;
        }
            
     }

     public function updateCartItem(int $cartItemId, array $validated)
     {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->update(['quantity' => $validated['quantity']]);
        return $cartItem;
     }

     public function removeCartItem(int $cartItemId)
     {
        $cartItem = CartItem::finOrFail($cartItemId);
        $cartItem->delete();

        return ['message' => 'Cart item removed'];
     }
}