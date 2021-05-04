@extends('backLayout.app')
@section('title')
{{ __('bck_users.Edit_Zipcode') }}
@stop

@section('content')

    <h1>{{ __('bck_users.Edit_Zipcode') }}</h1>
    <hr/>

    {!! Form::model($zipcode, [
        'method' => 'PATCH',
        'url' => ['zipcode', $zipcode->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', __('bck_users.Number').':' , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
             <div id="location_id" class="form-group {{ $errors->has('location_id') ? 'has-error' : ''}}">
                 {!! Form::label('location_id', __('bck_users.Location'), ['class' => 'col-md-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('location_id', $locations, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('location_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit( __('bck_users.Update'), ['class' => 'btn btn-primary form-control']) !!}
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
