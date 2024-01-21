<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Services\EmployeeService;
use App\Models\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->middleware('is_admin');
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'desc');
        $companyId = $request->input('company_id');
        $employees = $this->employeeService->getEmployees(10, $search, $sort, $companyId);
        $companies = Company::orderBy('name', 'asc')->get();
        return view('admin.employee.index', compact('employees', 'companies', 'sort', 'search', 'companyId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name', 'asc')->get();

        return view('admin.employee.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $validatedData = $request->validated();
        $this->employeeService->createEmployee($validatedData);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = $this->employeeService->getEmployeeById($id);
        return view('admin.employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = $this->employeeService->getEmployeeById($id);

        $companies = Company::orderBy('name', 'asc')->get();

        return view('admin.employee.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, string $id)
    {
        $employee = $this->employeeService->updateEmployee($id, $request->validated());
        return redirect()->route('employees.show', $employee->id)->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employeeDeleted = $this->employeeService->deleteEmployee($id);
        if ($employeeDeleted) {
            return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
        } else {
            return redirect()->route('employees.index')->with('error', 'Employee deleted unsuccessfully.');
        }
    }
}
