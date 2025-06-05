<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{ Company, Employee };
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeController extends Controller
{
   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|numeric',
            'company_id' => 'required',
        ]);
        Employee::create($validated);
    }

    public function destroy($id)
    {
        Employee::destroy($id);
    }
}
