@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>All Employees</h3>
                    <a href="{{ route('employees.create') }}" class="btn btn-success">Create New Employee</a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <form action="{{ route('employees.index') }}" method="GET" class="form-inline">
                                    <!-- Search Field -->
                                    <div class="form-group mr-2">
                                        <input type="text" name="search" placeholder="Search employees..." value="{{ request('search') }}" class="form-control">
                                    </div>

                                    <div class="form-group mr-2">
                                        <select name="company_id" class="form-control">
                                            <option value="">Select Company</option>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Search</button>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-4 text-right">
                            <a href="{{ route('employees.index', ['search' => request('search'), 'company_id' => request('company_id'), 'sort' => 'asc']) }}"
                                class="btn {{ request('sort') == 'asc' ? 'btn-secondary' : 'btn-outline-secondary' }} mr-2">
                                 Sort Asc
                             </a>
                             <a href="{{ route('employees.index', ['search' => request('search'), 'company_id' => request('company_id'), 'sort' => 'desc']) }}"
                                class="btn {{ request('sort') == 'desc' || request('sort') == null ? 'btn-secondary' : 'btn-outline-secondary' }}">
                                 Sort Desc
                             </a>
                        </div>
                    </div>
                    @if($employees->isEmpty())
                    <p class="text-center text-muted">No employees available. Please add some!</p>
                @else
                    @foreach ($employees as $employee)
                        <div class="row mb-4 border-bottom">
                            <div class="col-md-8 d-flex align-items-center">
                                <img src="{{ $employee->company->logo ? asset('storage/' . $employee->company->logo) : 'https://via.placeholder.com/100x100' }}" alt="{{ $employee->company->name }}" class="img-fluid" style="max-height: 50px; width: auto;">
                                <div class="ml-3">
                                    <strong>{{ $employee->fullname() }}</strong><br>
                                    <small>Company: {{ $employee->company->name }}</small><br>
                                    <small>Created at: {{ $employee->created_at->format('d M, Y') }}</small>
                                </div>
                            </div>

                            <div class="col-md-4 text-right d-flex align-items-center gap-2 justify-content-end">
                                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-primary btn-sm">View</a>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $employee->id }}">
                                    Delete
                                </button>

                            </div>
                        </div>
                        <div class="modal fade" id="deleteModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete {{ $employee->fullname()  }}?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    <div class="mt-3">
                        {{ $employees->appends([
                            'search' => request('search'),
                            'company_id' => request('company_id'),
                            'sort' => request('sort', 'desc')
                        ])->links('share.pagination') }}
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


