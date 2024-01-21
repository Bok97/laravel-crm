@extends('layouts.app')

@section('content')
<style>
    .clickable-row {
        cursor: pointer;
    }
</style>
<div class="container mt-4">
    <div class="row">
        <!-- Latest Companies Section -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Latest Companies</h4>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($companies as $company)
                        <li class="list-group-item clickable-row" data-href="{{ route('companies.show', $company->id) }}">
                            {{ $company->name }}
                        </li>
                    @empty
                        <li class="list-group-item">No companies available.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Latest Employees Section -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4>Latest Employees</h4>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($employees as $employee)
                        <li class="list-group-item clickable-row" data-href="{{ route('employees.show', $employee->id) }}">
                            {{ $employee->fullname() }}
                        </li>
                    @empty
                        <li class="list-group-item">No employees available.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.clickable-row').on('click', function() {
            window.location.href = $(this).data('href');
        });
    });
</script>


@endsection
