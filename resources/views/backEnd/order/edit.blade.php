@extends('backLayout.app')
@section('title')
{{ __('bck_order.Edit_Order') }}
@stop

@section('content')

    <h1>{{ __('bck_order.Edit_Order') }}</h1>
    <hr/>

    {!! Form::model($order, [
        'method' => 'PATCH',
        'url' => ['order', $order->id],
        'class' => 'form-horizontal'
    ]) !!}
            @if(!Sentinel::getUser()->inRole('manager'))
                <div class="form-group {{ $errors->has('cart_id') ? 'has-error' : ''}}">
                {!! Form::label('cart_id', __('bck_order.Cart_Id').':' , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('cart_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('cart_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('method') ? 'has-error' : ''}}">
                {!! Form::label('method', __('bck_order.Method').':' , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('method', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('method', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            @endif
            <div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
                {!! Form::label('total', __('bck_order.Total').':' , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('total', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                {!! Form::label('status', __('bck_order.Status').': ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                                <div class="checkbox">
                <label>{!! Form::radio('status', '1') !!} {{ __('bck_order.Yes') }}</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('status', '0') !!} {{ __('bck_order.No') }}</label>
            </div>
                    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit( __('bck_order.Update'), ['class' => 'btn btn-primary form-control']) !!}
            
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

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
            
            <a href="{{url('/').'/upload/invoice/INV-'.Sentinel::getUser()->id.'-'.$order->cart->id.'.pdf' }}" target="_blank" class="btn btn-primary form-control ">Invoice</a>
        </div>
    </div>

@endsection
