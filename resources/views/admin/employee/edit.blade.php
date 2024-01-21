@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header text-white bg-primary">
                    <span style="font-size:large">Edit Employee: {{ $employee->fullname() }}</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('employees.update', $employee->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="company_id" class="form-label">Company:</label>
                            <select name="company_id" id="company_id" class="form-control">
                                <option value="">Select Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ $employee->company_id == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group mb-3">
                            <label for="first_name" class="form-label">First Name:</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name', $employee->first_name) }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="last_name" class="form-label">Last Name:</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', $employee->last_name) }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $employee->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $employee->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Employee</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 text-end mt-2">
            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-secondary mt-2">Back</a>
        </div>
    </div>
</div>
@endsection

