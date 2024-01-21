{{-- resources/views/companies/show.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card shadow">
                <div class="card-header text-white bg-primary">
                    <span style="font-size:large">Name: {{ $employee->fullname() }}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <p><strong>Company:</strong> {{ $employee->company->name }}  {{ $employee->last_name }}</p>
                            <p><strong>First Name:</strong> {{ $employee->first_name }}</p>
                            <p><strong>Last Name:</strong> {{ $employee->last_name }}</p>
                            <p><strong>Email:</strong> {{ $employee->email }}</p>
                            <p><strong>Phone:</strong> {{ $employee->phone }}</p>
                        </div>
                        <div class="col-md-2">
                            <img src="{{ $employee->company->logo ? asset('storage/' . $employee->company->logo) : 'https://via.placeholder.com/100x100' }}"  alt="{{ $employee->name }}" class="img-fluid logo-image">
                        </div>
                    </div>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary mt-2">Edit</a>
                </div>
            </div>
        </div>
        <div class="col-md-8 text-end mt-2">
            <a href="{{ route('employees.index')}}" class="btn btn-secondary mt-2">Back</a>
        </div>
    </div>
</div>


<style>
    .logo-image {
        max-height: 100px;
        max-width: 100%;
        height: auto;
        width: auto;
        object-fit: contain;
    }
</style>

@endsection
