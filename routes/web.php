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
        Route::get('', [CompanyController::class, 'index'])
            ->name('index');

        Route::get('create', [CompanyController::class, 'create'])
            ->name('create');

        Route::post('', [CompanyController::class, 'store'])
            ->name('store');

        Route::get('{company}/edit', [CompanyController::class, 'edit'])
            ->name('edit');

        Route::put('{company}', [CompanyController::class, 'update'])
            ->name('update');
    });

    Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('', [EmployeeController::class, 'index'])
            ->name('index');

        Route::get('create', [EmployeeController::class, 'create'])
            ->name('create');

        Route::post('', [EmployeeController::class, 'store'])
            ->name('store');

        Route::get('{employee}/edit', [EmployeeController::class, 'edit'])
            ->name('edit');

        Route::put('{employee}', [EmployeeController::class, 'update'])
            ->name('update');

        Route::delete('{employee}', [EmployeeController::class, 'destroy'])
            ->name('destroy');
    });
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
