<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//ホーム画面へ
Route::get('/', [App\Http\Controllers\ItemController::class, 'homeIndex']);
//編集画面
Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit'])->name('edit');
//編集
Route::post('/itemEdit', [App\Http\Controllers\ItemController::class, 'itemEdit'])->name('itemEdit');
//削除
Route::post('/itemDelete', [App\Http\Controllers\ItemController::class, 'itemDelete'])->name('itemDelete');
//商品検索
Route::get('/item', [App\Http\Controllers\ItemController::class, 'getIndex'])->name('item');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
});
