<?php

use App\Http\Controllers\Administrator\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Notary\DashboardController as NotaryDashboardController;
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
Route::get('/', function(){
    return redirect()->route('getLoginPage');
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

    Route::post('/logout','logout')->name('logout');
});

// Administrator Routes
Route::prefix('administration')->group(function (){
    Route::get('/', [AdminDashboardController::class,'getAdminDashboardOverview'])->name('getAdminDashboardOverview');
});

//Notaries Routes
Route::prefix('notary')->group(function (){
    Route::get('/', [NotaryDashboardController::class,'getNotaryDashboardOverview'])->name('getNotaryDashboardOverview');
});

// Clients Routes

Route::prefix('client')->group(function (){
    Route::get('/',[ClientDashboardController::class,'getClientDashboardOverview'])->name('getClientDashboardOverview');
});



