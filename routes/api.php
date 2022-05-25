<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\BannerController;
use App\Http\Controllers\Api\v1\BrandController;
use App\Http\Controllers\Api\v1\MachineController;
use App\Http\Controllers\Api\v1\MachineTypeController;
use App\Http\Controllers\Api\v1\ProductCategoryController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->group(function() {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::apiResources([
    'products' => ProductController::class,
    'properties' => PropertyController::class,
    'banners' => BannerController::class,
    'brands' => BrandController::class,
    'machines' => MachineController::class,
    'machines-types' => MachineTypeController::class,
    'categories' => ProductCategoryController::class,
]);
