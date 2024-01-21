@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header text-white bg-primary">
                    <span style="font-size:large">Edit Company: {{ $company->name }}</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $company->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $company->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="logo" class="form-label">Logo (min 100x100px):</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" accept="image/*" id="logoInput" onchange="loadFile(event)">
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <img id="output" src="{{ $company->logo ? asset('storage/' . $company->logo) : 'https://via.placeholder.com/100x100' }}" alt="{{ $company->name }}" class="img-fluid" style="max-height: 100px;">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="website" class="form-label">Website:</label>
                            <input type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website', $company->website) }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Company</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 text-end mt-2">
            <a href="{{ route('companies.show', $company->id) }}" class="btn btn-secondary mt-2">Back</a>
        </div>
    </div>
</div>

<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>
@endsection

