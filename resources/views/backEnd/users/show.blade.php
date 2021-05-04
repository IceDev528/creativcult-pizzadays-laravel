@extends('backLayout.app')
@section('title')
{{ __('bck_users.Show_user') }}  {{$user->first_name}}
@stop

@section('content')
<div class="panel panel-default">
        <div class="panel-heading">{{ __('bck_users.User') }} :  {{$user->first_name}}</div>

        <div class="panel-body">

 <ul>
        <div class="row">
             {!! Form::label('first_name',__('bck_users.First_Name'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-sm-6">
                {{$user->first_name}}
            </div>
        </div>

       <div class="row">
             {!! Form::label('last_name', __('bck_users.Last_name'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-sm-6">
               {{$user->last_name}}
            </div>
        </div>

        <div class="row">
             {!! Form::label('email', __('bck_users.Email'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-sm-6">
               {{$user->email}}
            </div>
        </div>

         <div class="row">
             {!! Form::label('role', __('bck_users.User_role'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-sm-6">
                {{$user->roles->first()->name}}
            </div>
        </div>

        <div class="row">
        <br>
        <div class="col-md-6 col-md-offset-4">
            <a href="{{route('user.index')}}" class="btn btn-default">{{ __('bck_users.Return_to_all_users') }}</a>
            </div>
        </div>
    </ul>
    </div>
    </div>

@stop
