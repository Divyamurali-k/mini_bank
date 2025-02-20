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
            <li class="breadcrumb-item active">Add Customers</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        Import Customers
                        <a href="{{ route('customers.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>
                            Customers</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/customers-excel') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="file" class="form-label">Import Customers (Excel)</label>
                                        <input type="file" class="form-control" id="file" name="file"
                                            accept=".xlsx, .xls">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Import Customer</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
