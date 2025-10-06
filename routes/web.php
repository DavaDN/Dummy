<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\{
    CompanyController,
    AdminController,
    ClientController,
    ProjectController,
    ModuleController,
    ArticleController
};

Route::prefix('master')->group(function () {
    Route::resource('companies', CompanyController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('modules', ModuleController::class);
    Route::resource('articles', ArticleController::class);
});
