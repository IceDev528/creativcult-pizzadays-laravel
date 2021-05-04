@extends('backLayout.app')
@section('title')
{{ __('bck_order.Create_new_Order') }}
@stop

@section('content')

    <h1>{{ __('bck_order.Create_new_Order') }}</h1>
    <hr/>

    {!! Form::open(['url' => 'order', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('cart_id') ? 'has-error' : ''}}">
                {!! Form::label('cart_id', __('bck_order.Cart_Id'): , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('cart_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('cart_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('method') ? 'has-error' : ''}}">
                {!! Form::label('method', __('bck_order.Method'): , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('method', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('method', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
                {!! Form::label('total', __('bck_order.Total'): , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('total', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                {!! Form::label('status', __('bck_order.Status'): , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                                <div class="checkbox">
                <label>{!! Form::radio('status', '1') !!} {{ __('bck_order.Yes') }}</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('status', '0', true) !!} {{ __('bck_order.No') }}</label>
            </div>
                    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit(__('bck_auth.Create'), ['class' => 'btn btn-primary form-control']) !!}
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
