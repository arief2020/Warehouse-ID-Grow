<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/hello', function () {
    return response()->json(['message' => 'Hello, World!']);
});

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::middleware('auth:sanctum')->group(function () {
    // Users
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);

    // Mutations
    Route::post('/mutations', [MutationController::class, 'store']);
    Route::get('/mutations', [MutationController::class, 'index']);
    Route::get('/mutations/{id}', [MutationController::class, 'show']);
    Route::put('/mutations/{id}', [MutationController::class, 'update']);
    Route::delete('/mutations/{id}', [MutationController::class, 'destroy']);

    // Products
    Route::resource('products', ProductController::class);
    // Route::get('/products', [ProductController::class, 'index']);

    // mutation by User
    Route::middleware('auth:sanctum')->get('/users/{id}/mutations', [UserController::class, 'getMutationsbyUser']);

    // mutation by product
    Route::get('/products/{id}/mutations', [ProductController::class, 'getMutationsbyProduct']);
});

