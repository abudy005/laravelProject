@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">Dashboard</h4>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card text-center p-4">
                <h2 class="fw-bold text-primary">0</h2>
                <p class="mb-0 text-muted">Categories</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-4">
                <h2 class="fw-bold text-success">0</h2>
                <p class="mb-0 text-muted">Products</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-4">
                <h2 class="fw-bold text-warning">0</h2>
                <p class="mb-0 text-muted">Orders</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-4">
                <h2 class="fw-bold text-info">0</h2>
                <p class="mb-0 text-muted">Users</p>
            </div>
        </div>
    </div>
@endsection
