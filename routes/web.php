<?php

use App\Http\Controllers\Administrator\ClientsController as AdminClientsController;
use App\Http\Controllers\Administrator\DashboardController as AdminDashboardController;
use App\Http\Controllers\Administrator\NotariesController as AdminNotariesController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Client\FilesController as ClientFilesController;
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
    //Notaries
    Route::controller(AdminNotariesController::class)->group(function() {
        Route::prefix('notaries')->group(function (){
            Route::get('/approved','getApprovedNotaries')->name('getApprovedNotaries');
        });
    });
    //Clients
    Route::controller(AdminClientsController::class)->group(function() {
        Route::prefix('clients')->group(function() {
            Route::get('/','getAllClients')->name('getAllClients');
            Route::prefix('/{clientId}')->group(function() {
                Route::put('changeAccountStatus', 'changeAccountStatus')->name('changeAccountStatus');
            });
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
        Route::prefix('myTaggedFiles')->group(function() {
            Route::get('/','myTaggedFiles')->name('myTaggedFiles');
            Route::get('/{fileId}/getFileToProcess','getFileToProcess')->name('getFileToProcess');
            Route::post('/{fileId}/processClientFile','processClientFile')->name('processClientFile');
        });
    });
});

// Clients Routes

Route::prefix('client')->group(function (){
    Route::get('/',[ClientDashboardController::class,'getClientDashboardOverview'])->name('getClientDashboardOverview');
    Route::controller(ClientFilesController::class)->group(function() {
        Route::prefix('myFiles')->group(function (){
            Route::get('/','myClientFiles')->name('myClientFiles');
            Route::prefix('add')->group(function() {
                Route::get('/','addNewClientFile')->name('addNewClientFile');
                Route::post('/','saveNewClientFile')->name('saveNewClientFile');
            });
            Route::prefix('/{file}')->group(function() {
                Route::delete('/','deletePendingFile')->name('deletePendingFile');
                Route::get('/{disk}/download','downloadFile')->name('downloadClientFile');
            });
        });
    });
});



