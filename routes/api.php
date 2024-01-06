<?php

use App\Http\Controllers\AbacController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RbacController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Implementation with RBAC
 */
// Routes accessible to all roles
Route::get('/public-route', [RbacController::class, 'publicRoute']);

// Routes accessible to 'admin' role only
Route::middleware(['auth:sanctum','rbac:admin'])->group(function () {
    Route::get('/admin-route', [RbacController::class, 'adminOnly']);
});

// Routes accessible to 'customer' role only
Route::middleware(['auth:sanctum','rbac:customer'])->group(function () {
    Route::get('/customer-route', [RbacController::class, 'customerOnly']);
});

/**
 *  Implementation with ABAC
 */

// Routes accessible based on ABAC
Route::middleware('abac:read')->group(function () {
    Route::get('/read-file1', [AbacController::class, 'readFile1']);
});

Route::middleware('abac:write')->group(function () {
    Route::post('/write-file2', [AbacController::class, 'writeFile2']);
});
Route::post('/login', [AuthController::class, 'login']);
