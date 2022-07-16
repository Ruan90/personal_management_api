<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\DescriptionController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){

    //////////// Confirmação de autenticação ////////////////////////
    Route::get('/verify', [AuthController::class, 'verify']);
    /////////////////////////////////////////////////////////////////

    //////////// AUTHOR ////////////////////////////////////////////
    Route::get('/author', [AuthorController::class, 'index']);
    Route::get('/author/{id}', [AuthorController::class, 'show']);
    Route::get('/author/keyWord/{keyWord}', [AuthorController::class, 'showByKeyWord']);
    Route::post('/author', [AuthorController::class, 'store']);
    Route::patch('/author', [AuthorController::class, 'update']);
    Route::delete('/author/{id}', [AuthorController::class, 'destroy']);
    ////////////////////////////////////////////////////////////////

    //////////// CATEGORY /////////////////////////////////////////
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/{id}', [CategoryController::class, 'show']);
    Route::get('/category/keyWord/{keyWord}', [CategoryController::class, 'showByKeyWord']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::patch('/category', [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
    ///////////////////////////////////////////////////////////////

    /////////// REFERENCE //////////////////////////////////////////
    Route::get('/reference', [ReferenceController::class, 'index']);
    Route::get('/reference/{id}', [ReferenceController::class, 'show']);
    Route::post('/reference', [ReferenceController::class, 'store']);
    Route::patch('/reference', [ReferenceController::class, 'update']);
    Route::delete('/reference/{id}', [ReferenceController::class, 'destroy']);
    ////////////////////////////////////////////////////////////////

    //////////// DESCRIPTION ////////////////////////////////////////
    Route::get('/description', [DescriptionController::class, 'index']);
    Route::get('/description/{id}', [DescriptionController::class, 'show']);
    Route::post('/description', [DescriptionController::class, 'store']);
    Route::patch('/description/{id}', [DescriptionController::class, 'update']);
    Route::delete('/description/{id}', [DescriptionController::class, 'destroy']);

    Route::post('/category/description', [DescriptionController::class, 'storeCategory']);
    Route::get('/description/{id}', [DescriptionController::class, 'searchCategory']);
    /////////////////////////////////////////////////////////////////

    Route::post('/logout', [AuthController::class, 'logout']);
});
