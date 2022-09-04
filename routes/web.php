<?php

use App\Http\Controllers\Firebase\NotficateController;
use App\Http\Controllers\Firebase\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainpageController;
use App\Http\Controllers\RegisterController;
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



//Athentication registration
Route::get('register', [RegisterController::class, 'register']);
Route::post('save_user', [RegisterController::class, 'save_user']);

//login
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('user_login', [LoginController::class, 'user_login']);

Route::group(['middleware'=>'auth.user'], function(){
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [MainpageController::class, 'mainPage'])->name('mainPage');
    Route::get('/contacts', [ContactController::class, 'index']);
    Route::get('/add-contact', [ContactController::class, 'create']);
    Route::post('/add-contact', [ContactController::class, 'store']);
    Route::get('/edit-contact/{id}', [ContactController::class, 'edit']);
    Route::put('/update-contact/{id}', [ContactController::class, 'update']);
    Route::delete('/delete-contact/{id}', [ContactController::class, 'destroy']);
//    Route::get('/notificate', [NotficateController::class, 'NotificationForm']);
//    Route::post('/send-notification', [NotficateController::class, 'mysender']);
});
