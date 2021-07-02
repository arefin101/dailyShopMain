<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AdminPannelController;


Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware('IsLogged')->group(function () {
    Route::get('Home', [AdminPannelController::class, 'home'])->name('Home');
    Route::get('Admin_Profile', [AdminPannelController::class, 'profile'])->name('ProfileSettings');
    Route::get('Change_Password', [AdminPannelController::class, 'ChangePassword'])->name('ChangePassword');
    Route::post('Change_Password', [AdminPannelController::class, 'ChangedPassword'])->name('ChangedPassword');
    Route::get('viewprofile', [AdminPannelController::class, 'ViewProfile'])->name('ViewProfile');
    Route::post('Update_Profile', [AdminPannelController::class, 'UpdateProfile'])->name('UpdateProfile');
    Route::Get('upload_photo', [AdminPannelController::class, 'UploadPhoto'])->name('UploadPhoto');
    Route::Post('change_photo', [AdminPannelController::class, 'UploadedPhoto'])->name('UploadedPhoto');
});

Route::middleware('AllreadyLoggedin')->group(function(){
    Route::get("register", [UserAuthController::class, "register"])->name('register');
    Route::post("register", [UserAuthController::class, "registered"])->name('registered')->withoutMiddleware('AllreadyLoggedin');
    Route::get("login", [UserAuthController::class, "login"])->name('login');
    Route::post('login', [UserAuthController::class, 'check'])->name('check')->withoutMiddleware('AllreadyLoggedin');
});

Route::get("logout", [UserAuthController::class, "logout"])->name('logout');


//Route::get('home', [AdminPannelController::class, 'home'])->name('adminHome');