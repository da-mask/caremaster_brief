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
        return Inertia::render('Dashboard', [
            'employee_count' => Employee::count(),
            'companies' => Company::withCount('employees')->get()
        ]);
    }
}