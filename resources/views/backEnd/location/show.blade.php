@extends('backLayout.app')
@section('title')
{{ __('bck_location.Location') }}
@stop

@section('content')

    <h1>{{ __('bck_location.Location') }}</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ __('bck_attribute.ID') }}.</th> <th>{{ __('bck_attribute.Name') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $location->id }}</td> <td> {{ $location->name }} </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
