<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\{
    CompanyController, AdminController, ClientController,
    ProjectController, ModuleController, ArticleController
};

Route::apiResource('companies', CompanyController::class);
Route::apiResource('admins', AdminController::class);
Route::apiResource('clients', ClientController::class);
Route::apiResource('projects', ProjectController::class);
Route::apiResource('modules', ModuleController::class);
Route::apiResource('articles', ArticleController::class);

