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
                    <h3>All Companies</h3>
                    <a href="{{ route('companies.create') }}" class="btn btn-success">Create New Company</a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <form action="{{ route('companies.index') }}" method="GET" class="form-inline">
                                <input type="text" name="search" placeholder="Search companies..." value="{{ request('search') }}" class="form-control mr-2">
                                <button type="submit" class="btn btn-outline-primary">Search</button>
                            </form>
                        </div>
                        <div class="col-md-8 text-right">
                            <a href="{{ route('companies.index', ['search' => request('search'), 'sort' => 'asc']) }}"
                               class="btn {{ request('sort') == 'asc' ? 'btn-secondary' : 'btn-outline-secondary' }} mr-2">
                                Sort Asc
                            </a>
                            <a href="{{ route('companies.index', ['search' => request('search'), 'sort' => 'desc']) }}"
                               class="btn {{ request('sort') == 'desc' || request('sort') == null ? 'btn-secondary' : 'btn-outline-secondary' }}">
                                Sort Desc
                            </a>
                        </div>
                    </div>
                    @if($companies->isEmpty())
                    <p class="text-center text-muted">No companies available. Please add some!</p>
                @else
                    @foreach ($companies as $company)
                        <div class="row mb-4 border-bottom">
                            <div class="col-md-8 gap-4 d-flex align-items-center mb-4">
                                <img src="{{ $company->logo ? asset('storage/' . $company->logo) : "https://via.placeholder.com/100x100" }}" alt="{{ $company->name }}" class="img-fluid" style="max-height: 50px; width: auto;">
                                <div>
                                    <strong>{{ $company->name }}</strong><br>
                                    <small>Created at: {{ $company->created_at->format('d M, Y') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 text-right d-flex align-items-center gap-2 justify-content-end">
                                <a href="{{ route('companies.show', $company->id) }}" class="btn btn-primary btn-sm">View</a>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $company->id }}">
                                    Delete
                                </button>

                            </div>
                        </div>
                        <div class="modal fade" id="deleteModal{{ $company->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete {{ $company->name }}?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
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
                        {{ $companies->appends([
                            'search' => request('search'),
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


