@extends('backLayout.app')
@section('title')
Transaction
@stop

@section('content')

    <h1>Transaction</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Cart Id</th><th>Transaction Id</th><th>Method</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $transaction->id }}</td> <td> {{ $transaction->cart_id }} </td><td> {{ $transaction->transaction_id }} </td><td> {{ $transaction->method }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection