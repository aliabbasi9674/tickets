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







Route::prefix('admin')->name('admin.')->middleware('checkRole')->group(function (){
    $index_controller = 'App\Http\Controllers\Admin\IndexController';
    $user_controller = 'App\Http\Controllers\Admin\UserController';
    $ticket_controller = 'App\Http\Controllers\Admin\TicketController';
    $categories_controller = 'App\Http\Controllers\Admin\CategoryController';
    $profile_controller = 'App\Http\Controllers\Admin\ProfileController';

    Route::get('/index',[$index_controller,'index'])->name('index');


    Route::resource('users',$user_controller);
    Route::resource('tickets',$ticket_controller);
    Route::resource('categories',$categories_controller);
    Route::resource('profile',$profile_controller);
    Route::get('/tickets/message/{ticket}', [$ticket_controller, 'message'])->name('tickets.message');
    Route::post('/tickets/answer', [$ticket_controller, 'answer'])->name('tickets.answer');
    Route::post('/tickets/change/status', [$ticket_controller, 'status'])->name('tickets.status');
});


Route::name('home.')->group(function (){
    $index_controller = 'App\Http\Controllers\Home\IndexController';
    Route::get('/', [$index_controller, 'index'])->name('index')->middleware('guest');


    Route::prefix('user')->name('user.')->middleware('auth')->group(function (){
        $index_controller = 'App\Http\Controllers\Home\UserController';
        Route::get('/info', [$index_controller, 'info'])->name('info');
    });

    Route::prefix('tickets')->name('tickets.')->middleware('auth')->group(function (){
        $ticket_controller = 'App\Http\Controllers\Home\TicketController';
        Route::get('/', [$ticket_controller, 'index'])->name('index');
        Route::get('/create', [$ticket_controller, 'create'])->name('create');
        Route::post('/store', [$ticket_controller, 'store'])->name('store');
        Route::post('/answer', [$ticket_controller, 'answer'])->name('answer');
        Route::get('/message/{ticket}', [$ticket_controller, 'message'])->name('message');
        Route::post('/change/status', [$ticket_controller, 'status'])->name('status');
    });

});

Route::middleware('auth')->group(function (){
    $auth_controller = 'App\Http\Controllers\Auth\AuthController';
    Route::post('/logout',[$auth_controller,'logout'])->name('logout');
});


Route::middleware('guest')->group(function (){
    $auth_controller = 'App\Http\Controllers\Auth\AuthController';
    Route::any('/login',[$auth_controller,'login'])->name('login');
    Route::post('/check-otp',[$auth_controller,'otp'])->name('otp');
    Route::post('/resend-otp',[$auth_controller,'resendOtp'])->name('resend-otp');
});
