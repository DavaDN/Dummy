<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::apiResource('tickets', TicketController::class);
Route::apiResource('invoices', InvoiceController::class);
Route::apiResource('articles', ArticleController::class);
