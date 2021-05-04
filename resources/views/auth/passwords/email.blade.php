@extends('frontLayout.app')
@section('title')
Passwort vergessen
@stop
@section('styles')
@stop

@section('content')

<!-- Resistiren -->
    <div class="container-fluid" id="registiren">
      <div class="row row_re">


      </div>
      <div class="row justify-content-center row_form_re">
        <div class="col-8">
        <div class="col-12 col-lg-4 einkaufen_pch einkaufen_chtp  text-center">
           <h1>{{ __('auth.Passwort_vergessen') }}</h1>
        </div>
           @if (session('status'))
            <div class="alert alert-success sessions-hide" alert-dismissable fade in  >
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('status') }}
            </div>
            @endif
           {{ Form::open(array('url' => route('password.email'), 'class' => 'form-horizontal form-signin','files' => true)) }}
               {{ csrf_field() }}
            <div class="form-group row justify-content-center {{ $errors->has('email') ? 'has-error' : ''}} ">
              <div class="col-12 col-lg-4">
                {!! Form::email('email', null, ['class' => 'form-control edit_re','id'=>'Email-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=> __('auth.Email') ]) !!}
                  {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
              </div>
            </div>

            <div class="form-group row justify-content-center">
              <div class="col-12 col-lg-4 einkaufen_pch einkaufen_chtp">
                <button type="submit" class="btn btn-primary btn_lo_ein">{{ __('auth.Reset_Password') }}</button>
              </div>
            </div>
          {{ Form::close() }}


        </div>
      </div>
    </div>
    <!-- /.Registiren -->
@endsection

@section('scripts')


@endsection
