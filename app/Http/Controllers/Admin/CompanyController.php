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
        $companies = Company::all();
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
            'abn' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
        ]);

        Company::create($request->all());

        return redirect()->route('companies.index');
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return Inertia::render('company/Edit', [
            'company' => $company
        ]);
    }
}
