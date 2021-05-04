@extends('frontLayout.app')
@section('title')
Register
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
           <h1 class="mb-4">{{ __('auth.Registrieren') }}</h1>
        </div>
        @if (Session::has('message'))
         <div class="alert alert-{{(Session::get('status')=='error')?'danger':Session::get('status')}} " alert-dismissable fade in id="sessions-hide">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
           <strong>{{Session::get('status')}}!</strong> {!! Session::get('message') !!}
          </div>
        @endif

      </div>
      <div class="row justify-content-center row_form_re">
        <div class="col-8">
           {{ Form::open(array('url' => route('register'), 'class' => 'form-horizontal form-signin','files' => true)) }}
            {{ csrf_field() }}
            <div class="form-group row justify-content-center {{ $errors->has('first_name') ? 'has-error' : ''}}">
              <div class="col-12 col-lg-4">
                 {!! Form::text('first_name', null, ['class' => 'form-control edit_re','id'=>'Vorname-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=>__('auth.Vorname')]) !!}
                   {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="form-group row justify-content-center {{ $errors->has('last_name') ? 'has-error' : ''}} ">
              <div class="col-12 col-lg-4">
                {!! Form::text('last_name', null, ['class' => 'form-control edit_re','id'=>'Nachname-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=>__('auth.Nachname')]) !!}
                  {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="form-group row justify-content-center {{ $errors->has('address') ? 'has-error' : ''}} ">
              <div class="col-12 col-lg-4">
                {!! Form::text('address', null, ['class' => 'form-control edit_re','id'=>'Straße-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=>__('auth.Straße_Nr')]) !!}
                  {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="form-group row justify-content-center {{ $errors->has('ort') ? 'has-error' : ''}} ">
              <div class="col-12 col-lg-4">
                  {!! Form::text('ort', null, ['class' => 'form-control edit_re','id'=>'ORT-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=>__('auth.ORT')]) !!}
                  {!! $errors->first('ort', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="form-group row justify-content-center {{ $errors->has('plz') ? 'has-error' : ''}} ">
              <div class="col-12 col-lg-4">

                  {!! Form::select('plz', $zipcodes, null, ['class' => 'form-control edit_re','id'=>'PLZ-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=>__('auth.PLZ')]) !!}
                  {!! $errors->first('plz', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group row justify-content-center {{ $errors->has('email') ? 'has-error' : ''}} ">
              <div class="col-12 col-lg-4">
                {!! Form::email('email', null, ['class' => 'form-control edit_re','id'=>'Email-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=>__('auth.Email')]) !!}
                  {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="form-group row justify-content-center {{ $errors->has('password') ? 'has-error' : ''}} ">
              <div class="col-12 col-lg-4">
                 {!! Form::password('password', ['class' => 'form-control edit_re','id'=>'Password-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=>__('auth.Password')]) !!}
                  {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
            <div class="form-group row justify-content-center {{ $errors->has('password_confirmation') ? 'has-error' : ''}} ">
              <div class="col-12 col-lg-4">
                 {!! Form::password('password_confirmation', ['class' => 'form-control edit_re','id'=>'Password-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=>__('auth.Password_bestätigenv')]) !!}
                  {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group row justify-content-center">
              <div class="col-12 col-lg-4 einkaufen_pch einkaufen_chtp">
                <button type="submit" class="btn btn-primary btn_lo_ein">{{ __('auth.Create') }}</button>
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
