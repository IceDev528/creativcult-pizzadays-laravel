@extends('backLayout.app')
@section('title')
{{ __('bck_order.Order') }}
@stop

@section('content')

    <h1>{{ __('bck_order.Order') }} # {{ $order->id }}</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                <th>{{ __('bck_order.ID') }}</th>
                <th>{{ __('bck_order.Cart_Id') }}</th>
                <th>{{ __('bck_order.User_Name') }}</th>
                <th>{{ __('bck_order.Method') }}</th>
                <th>{{ __('bck_order.Status') }}</th>
                <th>{{ __('bck_order.Total') }}</th>
                <th>{{ __('bck_order.Delivery_Date') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order->id }}</td>
                     <td> {{ $order->cart_id }} </td>
                     <td> {{ $order->user->first_name.' '.$order->user->last_name }} </td>
                     <td> {{ $order->method }} </td>
                     <td> {{ $order->status }} </td>
                    <td> {{ $order->total }} {{$appsettings->currency}} </td>
                    <td> {{ $order->date_delivery }} </td>
                </tr>
            </tbody>
        </table>
    </div>
    <h1>Cart items</h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tblcartcheck">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Price </th>
                    <th>Quantity</th>
                    <th>Total</th>

                </tr>
            </thead>
            <tbody>
            @foreach($order->cart->product as $product)
                <tr>
                    <td>{{ $product->id }}</td>

                    <td> <img class="img-fluid mx-auto d-block" src="{{url('/').$product->path.'thumb_'.$product->image}}" alt="{{$product->name}}"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->ProductAttributeName($product->pivot->attribute)}}</td>
                    <td>{{ $product->ProductAttributePriceOne($product->pivot->attribute) }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ $product->ProductAttributePrice($product->pivot->attribute,$product->pivot->quantity)  }}</td>

                   

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            
            <a href="{{url('/').'/upload/invoice/INV-'.$order->user_id.'-'.$order->id.'.pdf' }}" target="_blank" class="btn btn-primary form-control ">Invoice</a>
        </div>
    </div>

@endsection
