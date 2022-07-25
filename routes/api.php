<?php

use App\Http\Controllers\API\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\API\KategoriController as APIKategoriController;
use App\Http\Controllers\API\LoginController;
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

Route::post('login', [LoginController::class, 'store']);
Route::get('login', [LoginController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/produk', [ProdukController::class, 'index']);
    Route::post('/produk', [ProdukController::class, 'store']);
    Route::get('/produk/{id}', [ProdukController::class, 'show']);
    Route::put('/produk/{id}/update', [ProdukController::class, 'update']);
    Route::post('/produk/{id}/delete', [ProdukController::class, 'destroy']);
});


// Route::resource('kategori', APIKategoriController::class, ' index');
//Route::get('kategori', [KategoriController::class, ' index']);






// Route::get('/kategori/data', [APIKategoriController::class, 'data']);
// Route::resource('/kategori/store', KategoriController::class);
