{{-- resources/views/companies/create.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header text-white bg-primary">
                    <span style="font-size:large">Create New Company</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="logo" class="form-label">Logo (min 100x100px):</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" accept="image/*">
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="website" class="form-label">Website:</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Company</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 text-end mt-2">
            <a href="{{ route('companies.index')}}" class="btn btn-secondary mt-2">Back</a>
        </div>
    </div>
</div>
@endsection
