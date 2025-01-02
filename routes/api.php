<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{order_id}', [OrderController::class, 'show']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders/{order_id}', [OrderController::class, 'update']);
Route::get('/contents/{cup_id}', [ContentController::class, 'show']);
Route::post('/contents', [ContentController::class, 'store']);


Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

Route::get('/product-recipes', [ProductRecipeController::class, 'index']);
Route::post('/product-recipes', [ProductRecipeController::class, 'store']);
Route::get('/product-recipes/{product}/{material}', [ProductRecipeController::class, 'show']);
Route::put('/product-recipes/{product}/{material}', [ProductRecipeController::class, 'update']);
Route::delete('/product-recipes/{product}/{material}', [ProductRecipeController::class, 'destroy']);

Route::get('/users', [Controller::class, 'index']);  
Route::get('/users/{id}', [Controller::class, 'show']); 
Route::post('/users', [Controller::class, 'store']);  
Route::put('/users/{id}', [Controller::class, 'update']);  
Route::delete('/users/{id}', [Controller::class, 'destroy']); 

Route::get('/order_items', [OrderItemController::class, 'index']);  
Route::get('/order_items/{order_id}', [OrderItemController::class, 'show']);  
Route::post('/order_items', [OrderItemController::class, 'store']);  
Route::put('/order_items/{order_id}', [OrderItemController::class, 'update']); 
Route::delete('/order_items/{order_id}', [OrderItemController::class, 'destroy']);  


