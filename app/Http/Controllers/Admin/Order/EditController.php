<?php

namespace App\Http\Controllers\Admin\Order;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Order $order) {
        $statuses = OrderStatus::cases();
        return view('order.edit', compact('order', 'statuses'));
    }
}
