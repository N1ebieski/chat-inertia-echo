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

Route::get('/', \App\Http\Controllers\Web\Chat\IndexController::class)
    ->name('web.chat.index');

Route::group(['middleware' => 'auth'], function () {
    Route::post('chat', \App\Http\Controllers\Web\Chat\StoreController::class)
        ->middleware(['permission:web.messages.create'])
        ->name('web.chat.store');

    Route::put('chat/{message}', \App\Http\Controllers\Web\Chat\UpdateController::class)
        ->middleware(['permission:web.messages.edit', 'can:edit,message'])
        ->where('message', '[0-9]+')
        ->name('web.chat.update');

    Route::delete('chat/{message}', \App\Http\Controllers\Web\Chat\DestroyController::class)
        ->middleware(['permission:web.messages.delete', 'can:delete,message'])
        ->where('message', '[0-9]+')
        ->name('web.chat.destroy');
});

Route::get('progress', \App\Http\Controllers\Web\ProgressController::class)
    ->name('web.progress');
