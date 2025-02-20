<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });

// Dashboard route (assuming you have a dashboard method in CustomerController)
Route::get('/', [CustomerController::class, 'dashboard'])->name('dashboard');

// Customer management routes
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customers.show');

Route::get('/customers/{id}/transactions', [TransactionController::class, 'showTransactions'])->name('customers.transactions');

Route::post('/customers/import', [CustomerController::class, 'storeexcel']);

Route::get('/customers-excel/create', [CustomerController::class, 'excelcreate'])->name('customers.excelcreate');
Route::post('/customers-excel', [CustomerController::class, 'excelstore'])->name('customers.excelstore');
