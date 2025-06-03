<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::withCount('employees')->get();
        return Inertia::render('company/Index', [
            'companies' => $companies
        ]);
    }

    public function create()
    {
        return Inertia::render('company/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'abn' => 'required|string|max:11|numeric',
            'email' => 'required|email|max:255|unique:companies,email',
            'address' => 'required|string|max:255',
        ]);
        Company::create($request->all());

        return to_route('companies.index');
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $employees = $company->employees;
        return Inertia::render('company/Edit', [
            'company' => $company,
            'employees' => $employees
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'abn' => 'required|string|max:11|numeric',
            'email' => 'required|email|max:255|unique:companies,email,',
            'address' => 'required|string|max:255',
        ]);
        Company::findOrFail($id)
            ->update($request->all());
        return to_route('companies.index');
    }   
}
