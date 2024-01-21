<?php

namespace App\Http\Controllers;

use App\Http\Services\CompanyService;
use App\Http\Services\EmployeeService;

class HomeController extends Controller
{
    protected $companyService;
    protected $employeeService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CompanyService $companyService, EmployeeService $employeeService)
    {
        $this->middleware('auth');
        $this->companyService = $companyService;
        $this->employeeService = $employeeService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return auth()->check() ? redirect()->route('admin.dashboard') : redirect()->route('login');
    }

    public function dashboard()
    {
        $companies = $this->companyService->getLatestCompanies();
        $employees = $this->employeeService->getLatestEmployees();

        return view('admin.dashboard', compact('companies', 'employees'));
    }
}
