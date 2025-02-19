@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('customers.index') }}">Customers</a>
            </li>
            <li class="breadcrumb-item active">Add New Customer</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        Add New Customer
                        <a href="{{ route('customers.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                            Customers</a>
                    </div>
                    <div class="card-body">
                      <form action="{{ url('/customers') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="firstName">Full name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text"
                                        aria-describedby="nameHelp" placeholder="Enter full name" value="{{ old('name') }}" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">Phone number</label>
                                    <input class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" type="tel"
                                        aria-describedby="phoneHelp" placeholder="Enter phone" value="{{ old('mobile') }}" />
                                    @error('mobile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="email">Email address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email"
                                        aria-describedby="emailHelp" placeholder="Enter email" value="{{ old('email') }}" />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password"
                                        aria-describedby="passwordHelp" placeholder="Enter password" />
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Customer</button>
                    </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
