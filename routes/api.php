<?php

use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'verified'])->prefix('/users')->group(function () {
    
    Route::get ('/getAll',      [UserController::class,     'getAll'])->name('users.all');
    Route::get('/user_status',  [UserController::class,     'defineOnlineSessionUsers'])->name('is.online');
    Route::post('/getMessages', [MessagesController::class, 'getMessages'])->name('get.messages');
    Route::post('/sendMessage', [MessagesController::class, 'sendMessage'])->name('send.message');

});

