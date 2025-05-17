<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(Product $product, UpdateRequest $request) {
        $data = $request->validated();
        $product->update($data);

        return view('product.show', compact('product'));
    }
}
