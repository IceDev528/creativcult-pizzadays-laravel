@extends('backLayout.app')
@section('title')
{{ __('bck_users.Edit_User') }}
@stop

@section('content')

<div class="panel panel-default">
   <div class="panel-heading">{{ __('bck_users.Edit_User') }}: {{$user->name}}</div>

     <div class="panel-body">

    {{ Form::model($user, array('method' => 'PATCH', 'url' => route('user.update', $user->id), 'class' => 'form-horizontal', 'files' => true)) }}
      <ul>
            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                 {!! Form::label('first_name', __('bck_users.First_Name'), ['class' => 'col-md-4 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

           <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                 {!! Form::label('last_name', __('bck_users.Last_name') , ['class' => 'col-md-4 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                 {!! Form::label('email', __('bck_users.Email'), ['class' => 'col-md-4 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('new_password') ? 'has-error' : ''}}">
                 {!! Form::label('new_password', __('bck_users.Password'), ['class' => 'col-md-4 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::password('new_password', ['class' => 'form-control']) !!}
                    {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('new_password_confirmation') ? 'has-error' : ''}}">
                 {!! Form::label('new_password_confirmation', __('bck_users.Password_Confirmation'), ['class' => 'col-md-4 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
                    {!! $errors->first('new_password_confirmation', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div id="role" class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
                 {!! Form::label('role', __('bck_users.User_role'), ['class' => 'col-md-4 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('role', $roles, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div id="address" class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
             {!! Form::label('address', __('frontend_cart.Straße_Nr'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('address', null, ['class' => 'form-control edit_re','id'=>'Straße-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=> __('frontend_cart.Straße_Nr').'*']) !!}
                {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div id="ort" class="form-group {{ $errors->has('ort') ? 'has-error' : ''}}">
             {!! Form::label('ort', __('frontend_cart.ORT'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('ort', null, ['class' => 'form-control edit_re','id'=>'ORT-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=> __('frontend_cart.ORT').'*']) !!}
                {!! $errors->first('ort', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div id="plz" class="form-group {{ $errors->has('plz') ? 'has-error' : ''}}">
             {!! Form::label('plz', __('frontend_cart.PLZ'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('plz', $zipcodes, null, ['class' => 'form-control edit_re','id'=>'PLZ-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=> __('frontend_cart.PLZ').'*']) !!}
                {!! $errors->first('plz', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div id="phone_number" class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
             {!! Form::label('phone_number', __('frontend_cart.Vorwahl_Rufnummer'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('phone_number', null, ['class' => 'form-control edit_re','id'=>'PLZ-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=> __('frontend_cart.Vorwahl_Rufnummer')]) !!}
                {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-3">
                    {!! Form::submit( __('bck_users.Submit'), ['class' => 'btn btn-success form-control']) !!}
                </div>
                <a href="{{route('user.index')}}" class="btn btn-default">{{ __('bck_users.Return_to_all_users') }}</a>
            </div>


        </ul>
    {{ Form::close() }}
    </div>
    </div>


@stop

@section('scripts')

@endsection
