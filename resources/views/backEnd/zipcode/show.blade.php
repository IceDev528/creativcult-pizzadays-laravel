@extends('backLayout.app')
@section('title')
{{ __('bck_users.Zipcode') }}
@stop

@section('content')

    <h1>{{ __('bck_users.Zipcode') }}</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>ID.</th> <th>{{ __('bck_users.Number') }}</th><th>{{ __('bck_users.Location_Id') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $zipcode->id }}</td> <td> {{ $zipcode->name }} </td><td> {{ $zipcode->location_id }} </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
