@extends('backLayout.app')
@section('title')
{{ __('bck_category.Category') }}
@stop

@section('content')

    <h1>{{ __('bck_category.Category') }}</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ __('bck_attribute.ID') }}.</th> <th>{{ __('bck_attribute.Name') }}</th><th>{{ __('bck_category.Slug') }}</th><th>{{ __('bck_category.Is_Parent') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $category->id }}</td> <td> {{ $category->name }} </td><td> {{ $category->slug }} </td><td> {{ $category->is_parent }} </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
