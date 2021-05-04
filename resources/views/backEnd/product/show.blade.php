@extends('backLayout.app')
@section('title')
{{ __('bck_product.Product') }}
@stop

@section('content')

    <h1>{{ __('bck_product.Product') }}</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ __('bck_attribute.ID') }}.</th> <th>{{ __('bck_attribute.Name') }}</th><th>{{ __('bck_category.Slug') }}</th><th>{{ __('bck_product.Category_Id') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $product->id }}</td> <td> {{ $product->name }} </td><td> {{ $product->slug }} </td><td> {{ $product->category_id }} </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
