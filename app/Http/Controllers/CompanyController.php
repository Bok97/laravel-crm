<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->middleware('is_admin');
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'desc');
        $companies = $this->companyService->getCompanies(10, $search, $sort);

        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $validatedData = $request->validated();
        $this->companyService->createCompany($validatedData);
        return redirect()->route('companies.index')->with('success', 'Company created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = $this->companyService->getCompanyById($id);
        return view('admin.company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = $this->companyService->getCompanyById($id);
        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, string $id)
    {
        $company = $this->companyService->updateCompany($id, $request->validated());
        return redirect()->route('companies.show', $company->id)->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $companyDeleted = $this->companyService->deleteCompany($id);
        if ($companyDeleted) {
            return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
        } else {
            return redirect()->route('companies.index')->with('error', 'Company deleted unsuccessfully.');
        }
    }
}
