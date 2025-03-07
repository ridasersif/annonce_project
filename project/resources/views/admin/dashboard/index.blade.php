<!-- resources/views/dashboard/index.blade.php -->
@extends('admin.layouts.app')

@section('content')
    <h2>Welcome to Society Dashboard</h2>

    <!-- Statistics -->
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Offers</h5>
                    <p class="card-text">15</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Clients</h5>
                    <p class="card-text">230</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Reservations</h5>
                    <p class="card-text">74</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text">$12,400</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
@endsection
