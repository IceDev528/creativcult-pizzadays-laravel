@extends('backLayout.app')
@section('title')
{{ __('bck_location.Edit_Location') }}
@stop

@section('content')

    <h1>{{ __('bck_location.Edit_Location') }}</h1>
    <hr/>

    {!! Form::model($location, [
        'method' => 'PATCH',
        'url' => ['location', $location->id],
        'class' => 'form-horizontal'
    ]) !!}

            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name',  __('bck_attribute.Name').' :', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div id="user_id" class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
             {!! Form::label('user_id','Manager Select', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('user_id', $managers, ($location->manager())?$location->manager()->id:false, ['class' => 'form-control','placeholder'=>'Select the location manager','required'=>'required']) !!}
                {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit( __('bck_attribute.Update') , ['class' => 'btn btn-primary form-control']) !!}
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
