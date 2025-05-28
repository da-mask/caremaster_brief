<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{ Company, Employee };
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        $employees = Employee::all();
        return Inertia::render('Dashboard', [
            'companies' => $companies,
            'employees' => $employees
        ]);
    }
}