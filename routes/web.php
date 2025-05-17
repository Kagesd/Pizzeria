<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::middleware(['auth', 'admin'])->group(function() {
    Route::group(['prefix' => 'admin'], function() {
        Route::get('/', \App\Http\Controllers\Admin\Main\IndexController::class)->name('admin.index');
    });
    Route::group(['prefix' => 'admin/products'], function() {
        Route::get('/', \App\Http\Controllers\Admin\Product\IndexController::class)->name('product.index');
        Route::get('/create', \App\Http\Controllers\Admin\Product\CreateController::class)->name('product.create');
        Route::post('/', \App\Http\Controllers\Admin\Product\StoreController::class)->name('product.store');
        Route::get('/{product}', \App\Http\Controllers\Admin\Product\ShowController::class)->name('product.show');
        Route::get('/{product}/edit', \App\Http\Controllers\Admin\Product\EditController::class)->name('product.edit');
        Route::patch('/{product}', \App\Http\Controllers\Admin\Product\UpdateController::class)->name('product.update');
        Route::delete('/{product}', \App\Http\Controllers\Admin\Product\DeleteController::class)->name('product.delete');
    });  
    Route::group(['prefix' => 'admin/categories'], function() {
        Route::get('/', \App\Http\Controllers\Admin\Category\IndexController::class)->name('category.index');
        Route::get('/create', \App\Http\Controllers\Admin\Category\CreateController::class)->name('category.create');
        Route::post('/', \App\Http\Controllers\Admin\Category\StoreController::class)->name('category.store');
        Route::get('/{category}', \App\Http\Controllers\Admin\Category\ShowController::class)->name('category.show');
        Route::get('/{category}/edit', \App\Http\Controllers\Admin\Category\EditController::class)->name('category.edit');
        Route::patch('/{category}', \App\Http\Controllers\Admin\Category\UpdateController::class)->name('category.update');
        Route::delete('/{category}', \App\Http\Controllers\Admin\Category\DeleteController::class)->name('category.delete');
    });  
    Route::group(['prefix' => 'admin/users'], function() {
        Route::get('/', \App\Http\Controllers\Admin\User\IndexController::class)->name('user.index');
        Route::get('/create', \App\Http\Controllers\Admin\User\CreateController::class)->name('user.create');
        Route::post('/', \App\Http\Controllers\Admin\User\StoreController::class)->name('user.store');
        Route::delete('/{user}', \App\Http\Controllers\Admin\User\DeleteController::class)->name('user.delete');
    }); 
    Route::group(['prefix' => 'admin/orders'], function() {
        Route::get('/', \App\Http\Controllers\Admin\Order\IndexController::class)->name('order.index');
        Route::get('/{order}/edit', \App\Http\Controllers\Admin\Order\EditController::class)->name('order.edit');
        Route::patch('/{order}', \App\Http\Controllers\Admin\Order\UpdateController::class)->name('order.update');
    }); 
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
