<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(User $user) {
        $categories = Category::all();
        return view('user.create', compact('categories', 'user'));
    }
}
