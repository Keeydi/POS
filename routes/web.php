<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;

Route::get('/', function () {
    return redirect('/login');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // POS Routes
    Route::prefix('pos')->group(function () {
        Route::get('/', [POSController::class, 'index'])->name('pos.index');
        Route::get('/table/{table}', [POSController::class, 'table'])->name('pos.table');
    });
    
    // Products
    Route::resource('products', ProductController::class);
    
    // Staff
    Route::resource('staff', StaffController::class);
    
    // Reports
    Route::prefix('reports')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/sales', [ReportController::class, 'sales'])->name('reports.sales');
        Route::get('/payroll', [ReportController::class, 'payroll'])->name('reports.payroll');
    });
    
    // Settings
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/business', [SettingsController::class, 'updateBusiness'])->name('settings.business');
    });
});
