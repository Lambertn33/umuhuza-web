<?php

use App\Http\Controllers\Administrator\DashboardController as AdminDashboardController;
use App\Http\Controllers\Administrator\NotariesController as AdminNotariesController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Notary\DashboardController as NotaryDashboardController;
use App\Http\Controllers\Notary\FilesController as NotaryFilesController;
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
    Route::controller(AdminNotariesController::class)->group(function() {
        Route::prefix('notaries')->group(function (){
            Route::get('/approved','getApprovedNotaries')->name('getApprovedNotaries');
        });
    });
});

//Notaries Routes
Route::prefix('notary')->group(function (){
    Route::get('/', [NotaryDashboardController::class,'getNotaryDashboardOverview'])->name('getNotaryDashboardOverview');
    Route::controller(NotaryFilesController::class)->group(function() {
        Route::prefix('myfiles')->group(function() {
            Route::get('/','myNotaryFiles')->name('myNotaryFiles');
            Route::prefix('add')->group(function() {
                Route::get('/','addNewNotaryFile')->name('addNewNotaryFile');
                Route::post('/','saveNewNotaryFile')->name('saveNewNotaryFile');
                Route::prefix('/{fileId}/users_confirm')->group(function() {
                    Route::get('/','getFileToConfirm')->name('getFileToConfirm');
                    Route::put('/','confirmFileUsers')->name('confirmFileUsers');
                });
            });
            Route::get('/{file}/download','downloadFile')->name('downloadFile');
        });
    });
});

// Clients Routes

Route::prefix('client')->group(function (){
    Route::get('/',[ClientDashboardController::class,'getClientDashboardOverview'])->name('getClientDashboardOverview');
});



