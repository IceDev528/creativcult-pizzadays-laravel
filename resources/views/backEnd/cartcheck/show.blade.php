@extends('backLayout.app')
@section('title')
Cartcheck
@stop

@section('content')

    <h1>Cartcheck</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>User Id</th><th>Favourite</th><th>Favourite Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $cartcheck->id }}</td> <td> {{ $cartcheck->user_id }} </td><td> {{ $cartcheck->favourite }} </td><td> {{ $cartcheck->favourite_name }} </td>
                </tr>
            </tbody>    
        </table>
    </div>

@endsection