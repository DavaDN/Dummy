<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::resource('tickets', TicketController::class);
Route::resource('invoices', InvoiceController::class);
Route::resource('articles', ArticleController::class);

