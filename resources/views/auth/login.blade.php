@extends('frontLayout.app')
@section('title')
Login
@stop

@section('content')
    <!-- Image Header -->
    <div class="container-fluid" id="image_header_pch">
      <div class="row row_image_header_pch">
         <div class="col">
            <img src="{{url('/')}}/frontend/img/header_registriren.png" class="img-fluid mx-auto d-block" alt="Pizza Days">
         </div>
      </div>
    </div>
    <!-- /.Image Header -->
    <!-- Resistiren -->
    <div class="container-fluid" id="registiren">
      <div class="row row_re">
        <div class="col-12 col-lg-2 col_text_re text-center">
           <h1 class="mb-4">{{ __('auth.Login') }}</h1>
        </div>
        @if (Session::has('message'))
         <div class="alert alert-{{(Session::get('status')=='error')?'danger':Session::get('status')}} sessions-hide" alert-dismissable fade in >
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
           <strong>{{Session::get('status')}}!</strong> {!! Session::get('message') !!}
          </div>
        @endif
      </div>
      <div class="row justify-content-center row_form_re">
        <div class="col-lg-6">
           {{ Form::open(array('url' => route('login'), 'class' => 'form-horizontal form-signin','files' => true)) }}
            {{ csrf_field() }}
                <div class="form-group row justify-content-center ">
                  <div class="col-12 col-lg-8 {{ $errors->has('email') ? 'has-danger' : ''}}">
                     {!! Form::text('email', null, ['class' => 'form-control edit_re','id'=>'email-input','placeholder '=>__('auth.Email'),'required'=>'required']) !!}
                     {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>
                <div class="form-group row justify-content-center">
                  <div class="col-12 col-lg-8 {{ $errors->has('password') ? 'has-danger' : ''}}">
                    {!! Form::password('password', ['class' => 'form-control edit_re','id'=>'password-input','placeholder '=>__('auth.Password'),'required'=>'required']) !!}
                   {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>
                <div class="form-check mb-2 mr-sm-2 mb-sm-0 col-12 col-lg-8 offset-lg-2 {{ $errors->has('rememeber') ? 'has-danger' : ''}}">
                  <label class="form-check-label angemeldet">
                    <input class="form-check-input" type="checkbox" name="rememeber"> {{ __('auth.angemeldet_bleiden') }}
                  </label>
                </div>
                <div class="row btn_einloggen">
                  <div class="col">
                     <button  class="btn btn-primary mx-auto d-block" name="Submit" value="Login" type="Submit">{{ __('auth.einloggen') }}</button>
                  </div>
                </div>
              {{ Form::close() }}
          <div class="row text-center password_vergessen">
                <div class="col">
                    <a href="{{url('password/reset')}}">{{ __('auth.Passwort_vergessen') }}?</a>
                    <p>{{ __('auth.MIT_FACEBOOK_ODER_GOOGLE_EINLOGGEN') }}</p>
                    <div class="row justify-content-center text-center mb-4">
                      <div class="col">
                        <a href="{{ url('/auth/facebook') }}"><i class="fa fa-facebook-square mr-4 fa_modal" aria-hidden="true"></i></a>
                        <a href="{{ url('/auth/twitter') }}"><i class="fa fa-twitter-square mr-4 fa_modal" aria-hidden="true"></i></a>
                        <a href="{{ url('/auth/google') }}"><i class="fa fa-google-plus fa_modal" aria-hidden="true"></i></a>
                      </div>
                    </div>
                </div>
          </div>

        </div>
      </div>
    </div>
    <!-- /.Registiren -->
@endsection

@section('scripts')

@endsection
