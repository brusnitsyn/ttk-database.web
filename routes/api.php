<?php

use App\Http\Controllers\Api\v1\CategoriesController;
use App\Http\Controllers\Api\v1\EquipmentManufacturerController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\TechniqueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResources([
    'products' => ProductController::class,
    'manufacturers' => EquipmentManufacturerController::class,
    'techniques' => TechniqueController::class,
]);
