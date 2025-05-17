<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function index()
    {
        $userId = auth('api')->id();
        $cartItems = $this->cartService->getCartItems($userId);
        
        return response()->json($cartItems);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        try{
            $userId = auth('api')->id();
            $cartItem = $this->cartService->addItemToCart($request->validated(), $userId);

            return response()->json($cartItem, 201);
        } catch(\Throwable $throwable) {
            return response()->json([
                'message' => $throwable->getMessage()
            ], 400);
        } 
    }

    public function update(UpdateCartRequest $request, int $cartId)
    {
        try{
            $cartItem = $this->cartService->updateCartItem($cartId, $request->validated());
            return response()->json($cartItem);
        } catch(\Throwable $throwable) {
            return response()->json([
                'message' => $throwable->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $cartId)
    {
        $result = $this->cartService->removeCartItem($cartId);
        return response()->json($result);
    }
}
