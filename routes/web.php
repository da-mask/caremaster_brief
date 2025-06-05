<?php

use App\Http\Controllers\Admin\{ DashboardController, CompanyController, EmployeeController};
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group( function () {
    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::prefix('companies')->name('companies.')->group(function () {

        Route::post('', [CompanyController::class, 'store'])
            ->name('store');

        Route::put('{company}', [CompanyController::class, 'update'])
            ->name('update');
        
        // API route for fetching employees of a company
        Route::get('{company}/employees', [CompanyController::class, 'getEmployees'])
            ->name('api.employees');
    });

    Route::prefix('employees')->name('employees.')->group(function () {
        Route::post('', [EmployeeController::class, 'store'])
            ->name('store');

        Route::put('{employee}', [EmployeeController::class, 'update'])
            ->name('update');

        Route::delete('{employee}', [EmployeeController::class, 'destroy'])
            ->name('destroy');
    });
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
