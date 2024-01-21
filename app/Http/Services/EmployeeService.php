<?php

namespace App\Http\Services;

use App\Models\Employee;

class EmployeeService
{
    public function getEmployees($perPage = 10, $search = null, $sort = 'desc', $companyId = null)
    {
        $query = Employee::with('company');

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('employees.first_name', 'like', '%' . $search . '%')
                    ->orWhere('employees.last_name', 'like', '%' . $search . '%');
            });
        }

        if ($companyId) {
            $query->where('company_id', $companyId);
        }

        $sortOrder = strtolower($sort) == 'asc' ? 'asc' : 'desc';
        $query->orderBy('created_at', $sortOrder);

        return $query->paginate($perPage);
    }

    public function createEmployee($data)
    {
        return Employee::create($data);
    }

    public function getEmployeeById($id)
    {
        return Employee::findOrFail($id);
    }

    public function updateEmployee($id, $data)
    {
        $employee = Employee::findOrFail($id);

        $employee->update($data);

        return $employee;
    }

    public function deleteEmployee($id)
    {
        try {
            $employee = Employee::find($id);
            if (!$employee) {
                return false;
            }
            $employee->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getLatestEmployees($limit = 10)
    {
        return Employee::latest()->take($limit)->get();
    }
}
