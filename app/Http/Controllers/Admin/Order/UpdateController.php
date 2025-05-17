<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(Order $order, UpdateOrderRequest $request) {
        $validated = $request->validated();
        $order->update(['status' => $validated['status']]);
        return redirect()->back()->with('success', 'Статус обновлен!');
    }
}
