<?php

use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', function(){
    return redirect()->route('login');
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::prefix('login')->group(function() {
        Route::get('/','getLoginPage')->name('getLoginPage');
        Route::post('/','authenticate')->name('authenticate');
    });
    Route::prefix('register')->group(function() {
        Route::get('/', 'getRegistrationPage')->name('getRegistrationPage');
        Route::post('/', 'registerOnFirstPage')->name('registerOnFirstPage');
        Route::prefix('next')->group(function() {
            Route::get('/','getRegistrationNextPage')->name('getRegistrationNextPage');
            Route::post('/','submitRegistration')->name('submitRegistration');
            Route::get('/thank-you','getConfirmationPage')->name('getConfirmationPage');
        });
    });
});



