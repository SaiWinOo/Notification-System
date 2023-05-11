<?php

use App\Events\OrderStatusUpdate;
use App\Models\User;
use App\Notifications\InvoicePaid;
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
    return inertia('hello/welcome', ['user', auth()->user()]);
})->middleware('auth');
Route::get('/user', function () {
    $user = User::find(1);
    $notification = new InvoicePaid();
    $user->notify($notification);
    return 'success';
});

Route::get('login', function () {
    if (auth()->attempt(['email' => 'madyson50@example.com', 'password' => 'password'])) {
        return 'true';
    }
});
Route::get('/orders', function () {
    OrderStatusUpdate::dispatch();
    return 'hello world order';
});
