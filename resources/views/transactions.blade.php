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
            <li class="breadcrumb-item active">Transactions</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h5>Listing Transactions of <b>User 1</b></h5>
                            <p>Balance : {{ $customer->amount}}</p>
                        </div>
                        <div>
                            <a href="{{ route('customers.index') }}" class="btn btn-primary"><i
                                    class="fa fa-arrow-left"></i>
                                Customers</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>ip</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ ucfirst($transaction->type) }}</td>
                                        <td>{{ $transaction->date }}</td>
                                        <td>${{ $transaction->amount }}</td>
                                        <td>{{ $transaction->ip }}</td>
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
