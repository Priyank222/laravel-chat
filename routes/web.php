<?php

use App\Http\Controllers\chat;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/test', [chat::class, 'test_message']);
    Route::get('/public_chat', [chat::class, 'public_message']);
    Route::post('/send_message', [chat::class, 'send_message']);
    Route::post('/send_message_private', [chat::class, 'send_message_private']);

    Route::get('/get_users', [chat::class, 'get_users']);
    Route::post('/fetch_messages', [chat::class, 'fetch_messages']);

});

require __DIR__.'/auth.php';
