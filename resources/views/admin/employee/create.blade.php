@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header text-white bg-primary">
                    <span style="font-size:large">Create New Employee</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="company_id" class="form-label">Company:</label>
                            <select name="company_id" id="company_id" class="form-control @error('company_id') is-invalid @enderror">
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="first_name" class="form-label">First Name:</label>
                            <input type="text" id="first_name" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autofocus>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="last_name" class="form-label">Last Name:</label>
                            <input type="text" id="last_name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="tel" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Employee</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 text-end mt-2">
            <a href="{{ route('employees.index')}}" class="btn btn-secondary mt-2">Back</a>
        </div>
    </div>
</div>
@endsection
