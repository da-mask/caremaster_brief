<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return Inertia::render('employee/Index', [
            'employees' => $employees
        ]);
    }

    public function create()
    {
        return Inertia::render('employee/Create');
    }
}
