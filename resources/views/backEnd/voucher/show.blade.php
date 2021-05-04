@extends('backLayout.app')
@section('title')
Voucher
@stop

@section('content')

    <h1>Voucher</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>Code</th><th>Name</th><th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $voucher->id }}</td> <td> {{ $voucher->code }} </td><td> {{ $voucher->name }} </td><td> {{ $voucher->description }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection