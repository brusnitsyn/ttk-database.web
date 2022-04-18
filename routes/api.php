<?php

use App\Http\Controllers\Api\v1\BrandController;
use App\Http\Controllers\Api\v1\MachineController;
use App\Http\Controllers\Api\v1\MachineTypeController;
use App\Http\Controllers\Api\v1\ProductController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'products' => ProductController::class,
    'brands' => BrandController::class,
    'machines' => MachineController::class,
    'machines-types' => MachineTypeController::class,
]);
