<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OSController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Detail_OSController;
use App\Http\Controllers\DocumentTemplateController;
use App\Http\Controllers\UserManageController;
use App\Models\DocumentTemplate;

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

// Fitur login - logout
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
// Fitur login - logout

Route::get('/user-manage', [UserManageController::class, 'index']);
Route::get('/user-manage/create', [UserManageController::class, 'create']);
Route::post('/user-manage', [UserManageController::class, 'store']);
Route::get('/user-manages/{id}', [UserManageController::class, 'show']);
Route::get('/user-manages/{id}/edit', [UserManageController::class, 'edit']);
Route::put('/user-manages/{id}', [UserManageController::class, 'update']);
Route::delete('/user-manages/{id}', [UserManageController::class, 'destroy']);


Route::get('/organization-structures', [OSController::class, 'index']);
Route::get('/organization-structures/create', [OSController::class, 'create']);
Route::post('/organization-structures', [OSController::class, 'store']);
Route::delete('/organization-structures/{id}', [OSController::class, 'destroy']);
Route::get('/organization-structures/{id}/edit', [OSController::class, 'edit']);
Route::put('/organization-structures/{id}', [OSController::class, 'update']);


Route::get('/detail-organization-structures', [Detail_OSController::class, 'index']);
Route::get('/detail-organization-structures/create', [Detail_OSController::class, 'create']);
Route::post('/detail-organization-structures', [Detail_OSController::class, 'store']);
Route::get('/detail-organization-structures/{id}', [Detail_OSController::class, 'show']);
Route::get('/detail-organization-structures/{id}/edit', [Detail_OSController::class, 'edit']);
Route::put('/detail-organization-structures/{id}', [Detail_OSController::class, 'update']);
Route::delete('/detail-organization-structures/{id}', [Detail_OSController::class, 'destroy']);


Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/create', [ProductController::class, 'create']);
Route::post('/product', [ProductController::class, 'store']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
Route::put('/product/{id}', [ProductController::class, 'update']);
Route::delete('/product/{id}', [ProductController::class, 'destroy']);
// Route::get('/product/{id}/edit_file', [ProductController::class, 'edit']);
Route::put('/product/{id}/update_file', [ProductController::class, 'update_file']);




Route::get('/document-templates', [DocumentTemplateController::class, 'index']);
