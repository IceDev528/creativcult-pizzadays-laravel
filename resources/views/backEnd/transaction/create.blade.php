@extends('backLayout.app')
@section('title')
Create new Transaction
@stop

@section('content')

    <h1>Create New Transaction</h1>
    <hr/>

    {!! Form::open(['url' => 'transaction', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('cart_id') ? 'has-error' : ''}}">
                {!! Form::label('cart_id', 'Cart Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('cart_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('cart_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('transaction_id') ? 'has-error' : ''}}">
                {!! Form::label('transaction_id', 'Transaction Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('transaction_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('transaction_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('method') ? 'has-error' : ''}}">
                {!! Form::label('method', 'Method: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('method', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('method', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
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

@endsection