 <!-- Footer -->
    <div class="container-fluid" id="footer">
      <div class="row justify-content-center">
        <div class="col">
          <img src="{{url('/')}}/frontend/img/poi.png" class="img-fluid mx-auto d-block">
        </div>
      </div>
      <div class="row row_content_footer">
        <div class="col text-center">
            <a class="item_footer" href="{{url('shop/pizza')}}"> {{ __('frontend_cart.Pizza') }}  -</a>
            <a class="item_footer" href="{{url('shop/pasta')}}"> {{ __('frontend_cart.Pasta') }}  -</a>
            <a class="item_footer" href="{{url('shop')}}"> {{ __('frontend_cart.Abgebot') }}  -</a>
            <a class="item_footer" href="#" data-toggle="modal" data-target="#myModal2"> {{ __('frontend_cart.Kontakt') }}  -</a>
            <a class="item_footer" href="{{url('about-us')}}"> {{ __('frontend_cart.Uber_Uns') }}  -</a>
            <a class="item_footer" href="#"> {{ __('frontend_cart.Jobs') }}  -</a>
            <a class="item_footer" href="#"> {{ __('frontend_cart.My_Account') }}  -</a>
            <a class="item_footer" href="#"> Impressum </a>
        </div>
      </div>
      <div class="row justify-content-center text-center mb-4">
        <div class="col">
          <a href=""><i class="fa fa-facebook-square mr-4" aria-hidden="true"></i></a>
          <a href=""><i class="fa fa-twitter-square mr-4" aria-hidden="true"></i></a>
          <a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a>
        </div>
      </div>

      <!-- Modal 1 -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content text-center">
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <p>{{ __('frontend_cart.Als_Kunde_einloggen') }}</p>
               {{ Form::open(array('url' => route('login'), 'class' => 'form-horizontal form-signin','files' => true)) }}
                <div class="form-group row justify-content-center ">
                  <label for="email-input" class="col-12 col-form-label email_modal">{{ __('frontend_cart.Email') }}* :</label>
                  <div class="col-6 {{ $errors->has('email') ? 'has-danger' : ''}}">
                     {!! Form::text('email', null, ['class' => 'form-control','id'=>'email-input','placeholder '=> __('frontend_cart.Email').'*' ,'required'=>'required']) !!}
                     {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>
                <div class="form-group row justify-content-center">
                  <label for="password-input" class="col-12 col-form-label Password_modal">{{ __('frontend_cart.Password') }}*:</label>
                  <div class="col-6 {{ $errors->has('password') ? 'has-danger' : ''}}">
                    {!! Form::password('password', ['class' => 'form-control','id'=>'password-input','placeholder '=> __('frontend_cart.Password').'*','required'=>'required']) !!}
                   {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>
                <div class="form-check mb-2 mr-sm-2 mb-sm-0 {{ $errors->has('rememeber') ? 'has-danger' : ''}}">
                  <label class="form-check-label angemeldet">
                    <input class="form-check-input" type="checkbox" name="rememeber"> {{ __('frontend_cart.angemeldet_bleiden') }}
                  </label>
                </div>
                <div class="row btn_einloggen">
                  <div class="col">
                     <button  class="btn btn-primary mx-auto d-block" name="Submit" value="Login" type="Submit">{{ __('frontend_cart.einloggen') }}</button>
                  </div>
                </div>
              {{ Form::close() }}
              <div class="row text-center password_vergessen">
                <div class="col">
                    <a href="{{url('password/reset')}}">{{ __('frontend_cart.Passwort_vergessen') }}?</a>
                    <p>MIT FACEBOOK ODER GOOGLE + EINLOGGEN</p>
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
      </div>
      <!-- /.Modal 1 -->

      <!-- Modal 2 -->
      <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content text-center">
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h3 class="mb-4">{{ __('frontend_cart.Kontakt') }}</h3>
              <form>
                <div class="form-group row mt-4">
                  <label for="text-input-name-kontakt" class="col-4 col-form-label text-left"><h4>{{ __('frontend_cart.Name') }}*:</h4></label>
                  <div class="col-8">
                    <input class="form-control" type="text"  id="text-input-name-kontakt">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="text-input-vorname-kontakt" class="col-4 col-form-label text-left"><h4>{{ __('frontend_cart.Vorname') }}*:</h4></label>
                  <div class="col-8">
                    <input class="form-control" type="text"  id="text-input-vorname-kontakt">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email-input-kontakt" class="col-4 col-form-label text-left"><h4>{{ __('frontend_cart.Email') }}*:</h4></label>
                  <div class="col-8">
                    <input class="form-control" type="email" id="email-input-kontakt">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="kontaktTextarea" class="col-4 text-left"><h4>{{ __('frontend_cart.Nachricht') }}*:</h4></label>
                  <div class="col-8">
                     <textarea class="form-control" id="kontaktTextarea" rows="3"></textarea>
                  </div>
                </div>
                <div class="row btn_einloggen">
                  <div class="col">
                    <button type="button" class="btn btn-primary mx-auto d-block">{{ __('frontend_cart.Senden') }}</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /.Modal 2 -->
    </div>
    <!-- /.Footer -->

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="{{ URL::asset('/frontend/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ URL::asset('/frontend/js/tether.min.js') }}"></script>
    <script src="{{ URL::asset('/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('/frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::asset('/frontend/js/toastr.js') }}"></script>
    <script src="{{ URL::asset('/frontend/js/custom.js') }}?v=4"></script>


    @include('frontLayout.sessions')
    <script>
      $('.sessions-hide').delay(5000).slideUp(300);
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
    </script>
    @yield('scripts')
  </body>
</html>
