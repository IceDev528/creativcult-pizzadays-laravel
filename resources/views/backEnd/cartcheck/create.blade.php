@extends('backLayout.app')
@section('title')
Create new Cartcheck
@stop

@section('content')

    <h1>Create New Cartcheck</h1>
    <hr/>

    {!! Form::open(['url' => 'cartcheck', 'class' => 'form-horizontal']) !!}

                <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
                {!! Form::label('user_id', 'User Id: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
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
                {!! Form::label('status', 'Status: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                                <div class="checkbox">
                <label>{!! Form::radio('status', '1') !!} Yes</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('status', '0', true) !!} No</label>
            </div>
                    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
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