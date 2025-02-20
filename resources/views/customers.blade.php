@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Customers</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        Listing Customers
                        <a href="{{ route('customers.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add
                            Customer</a>
                            <a href="{{ route('customers.excelcreate') }}" class="btn btn-primary"><i class="fa fa-download"></i> Import
                                Customer</a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Customer Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Amount</th>
                                    <th>Created On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    @foreach ($customers as $customer)
                                    <tr>
                                    <td>#C000{{ $customer->customer_id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->mobile }}</td>
                                    <td>{{ $customer->amount }}</td>
                                    <td>{{ $customer->created_at }}</td>
                                    <td><a href="{{ route('customers.transactions', ['id' => $customer->customer_id]) }}" class="btn btn-sm btn-primary">
                                      Transactions</a></td> 
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
