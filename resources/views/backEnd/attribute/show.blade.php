@extends('backLayout.app')
@section('title')
{{ __('bck_attribute.Attribute') }}
@stop

@section('content')

    <h1>{{ __('bck_attribute.Attribute') }}</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ __('bck_attribute.ID') }}.</th> <th>{{ __('bck_attribute.Name') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $attribute->id }}</td> <td> {{ $attribute->name }} </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
