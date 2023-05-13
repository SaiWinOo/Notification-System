<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Notifications\LikeComment;
use Illuminate\Http\Request;

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
    return inertia('hello/welcome');
});

Route::get('/login', function () {

    return inertia('Auth/Login');
});

Route::post('/login', function () {
    if (auth()->attempt(['email' => request('email'), 'password' => request('password')])) {
        return redirect('/');
    }
});


Route::post('/notify', function (Request $request) {
    $userToSendNotiTo = User::whereEmail($request->email)->first();
    $userToSendNotiTo->notify(new LikeComment(auth()->user()->name, $request->message, $request->url));
    return back();
});
