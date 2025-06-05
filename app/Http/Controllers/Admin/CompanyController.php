<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'abn' => 'required|string|numeric',
            'email' => 'required|email|max:255|unique:companies,email',
            'address' => 'required|string|max:255',
        ]);
        Company::create($validated);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'abn' => 'required|string|numeric',
            'email' => 'required|email|max:255|unique:companies,email,'.$id,
            'address' => 'required|string|max:255',
        ]);
        Company::findOrFail($id)
            ->update($validated);
    }

    public function getEmployees($id): JsonResponse
    {
        $company = Company::findOrFail($id);
        $employees = $company->employees;

        return response()->json($employees);
    }
}
