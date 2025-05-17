<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke() {
        
        $orders = Order::with('items.product')->latest()->get();
        return view('order.index', compact('orders'));
    }
}
