<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.companies', [
            'companies' => Auth::user()->companies()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.create-company');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Request\CompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company = Auth::user()->companies()->create($request->only('name'));
        $company->clients()->sync($request->input('clients', []));

        return redirect()->route('company.edit', $company->id)
            ->with('success', 'Company created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Company $company
     * @return \Illuminate\View\View
     */
    public function edit(Company $company)
    {
        $this->authorize('owner', $company);
        $company->with('clients');

        return view('admin.create-company', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $this->authorize('owner', $company);
        $company->update($request->only('name'));
        $company->clients()->sync($request->input('clients', []));

        return redirect()->route('company.edit', $company->id)
            ->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $this->authorize('owner', $company);
        $company->delete();

        return redirect()->route('company.index')
            ->with('success', 'Company deleted successfully');
    }
}
