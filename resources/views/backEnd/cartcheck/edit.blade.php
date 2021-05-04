@extends('backLayout.app')
@section('title')
Edit Cart
@stop

@section('content')

    <h1>Edit Cart</h1>
    <hr/>

    {!! Form::model($cartcheck, [
        'method' => 'PATCH',
        'url' => ['cartcheck', $cartcheck->id],
        'class' => 'form-horizontal'
    ]) !!}

             <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                {!! Form::label('user_id', 'User Email ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                   
                     {!! Form::select('user_id', $users, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('favourite') ? 'has-error' : ''}}">
                {!! Form::label('favourite', 'Favourite: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                                <div class="checkbox">
                <label>{!! Form::radio('favourite', '1') !!} Yes</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('favourite', '0', true) !!} No</label>
            </div>
                    {!! $errors->first('favourite', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('favourite_name') ? 'has-error' : ''}}">
                {!! Form::label('favourite_name', 'Favourite Name: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('favourite_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('favourite_name', '<p class="help-block">:message</p>') !!}
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
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
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
            @foreach($cartcheck->product as $product)
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

@endsection