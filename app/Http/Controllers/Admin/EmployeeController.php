<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{ Company, Employee };
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

    public function create(Request $request)
    {
        return Inertia::render('employee/Create', [
            'company_id' => $request->company_id
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|numeric',
            'company_id' => 'required',
        ]);
        Employee::create($request->all());
        return to_route('companies.edit', $request->company_id);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $companyId = $employee->company_id;
        $employee->delete();
        return to_route('companies.edit', $companyId);
    }
}
