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
                    <span style="font-size:large">{{ $company->name }}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <p><strong>Name:</strong> {{ $company->name }}</p>
                            <p><strong>Email:</strong> {{ $company->email }}</p>
                            <p><strong>Website:</strong> {{ $company->website }}</p>
                        </div>
                        <div class="col-md-2">
                            <img src="{{ $company->logo ? asset('storage/' . $company->logo) : 'https://via.placeholder.com/100x100' }}"  alt="{{ $company->name }}" class="img-fluid logo-image">
                        </div>
                    </div>
                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary mt-2">Edit</a>
                </div>
            </div>
        </div>
        <div class="col-md-8 text-end mt-2">
            <a href="{{ route('companies.index')}}" class="btn btn-secondary mt-2">Back</a>
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
