@extends('frontLayout.app')
@section('title')
{{ __('frontend_cart.Locations') }}
@stop
@section('content')
 <!-- Image Header -->
    <div class="container-fluid" id="image_header_pch">
      <div class="row row_image_header_pch">
         <div class="col">
            <img src="{{url('/')}}/frontend/img/backg.png" class="img-fluid mx-auto d-block" alt="Pizza Days">
         </div>
      </div>
    </div>
    <!-- /.Image Header -->

    <!-- Loaction 1 -->
    <div class="container-fluid" id="location_main">
      <div class="row location_1_lo">
        <div class="col-12 col-lg-6 carousel_lo">
            <div class="owl-carousel owl-theme">
              <div class="item"> <img src="{{url('/')}}/frontend/img/location_1.jpg" class="img-fluid mx-auto d-block"> </div>
              <div class="item"> <img src="{{url('/')}}/frontend/img/location_1.jpg" class="img-fluid mx-auto d-block"> </div>
              <div class="item"> <img src="{{url('/')}}/frontend/img/location_1.jpg" class="img-fluid mx-auto d-block"> </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 city_lo">
            <div class="row">
              <div class="col-6">
                <h1>FULDA</h1>
              </div>
              <div class="col-6">
                <p>DARMSTADT SÜD (DE)</p>
                <p>Bessunger Straße 122,</p>
                <p>64285 Darmstadt</p>
                <br>
                <p>TEL.: +49 (6151) 60 40 40</p>
              </div>
            </div>
            <div class="row">
                <div class="col-12 einkaufen_pch einkaufen_chtp einkaufen_lo">
                    <button type="button" class="btn btn-primary btn_lo_ein">{{ __('frontend_cart.einkaufen') }}</button>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 adress_lo">
          <div class="row">
            <div class="col-12">
              <p>ÖFFNUNGSZEITEN</p>
              <p>MI</p>
              <p>11:00 - 23:00</p>
              <p>MITTWOCH 11:00 bis 23:00</p>
              <p>DO</p>
              <p>11:00 - 23:00</p>
              <p>DONNERSTAG 11:00 bis 23:00</p>
              <p>FR</p>
              <p>11:00 - 23:00</p>
              <p>FREITAG 11:00 bis 23:00</p>
              <p>SA</p>
              <p>11:00 - 23:00</p>
              <p>SAMSTAG 11:00 bis 23:00</p>
              <p>SO</p>
              <p>11:00 - 23:00</p>
              <p>SONNTAG 11:00 bis 23:00</p>
              <p>MO</p>
              <p>11:00 - 23:00</p>
              <p>MONTAG 11:00 bis 23:00</p>
              <p>DI</p>
              <p>11:00 - 23:00</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Loaction 1 -->

    <!-- Loaction 2 -->
    <div class="container-fluid" id="location_main_1">
      <div class="row location_1_lo">
          <div class="col-12 col-lg-3 city_lo">
              <div class="row">
                <div class="col-6">
                  <h1>FULDA</h1>
                </div>
                <div class="col-6">
                  <p>DARMSTADT SÜD (DE)</p>
                  <p>Bessunger Straße 122,</p>
                  <p>64285 Darmstadt</p>
                  <br>
                  <p>TEL.: +49 (6151) 60 40 40</p>
                </div>
              </div>
              <div class="row">
                  <div class="col-12 einkaufen_pch einkaufen_chtp einkaufen_lo">
                      <button type="button" class="btn btn-primary btn_lo_ein">{{ __('frontend_cart.einkaufen') }}</button>
                  </div>
              </div>
          </div>
          <div class="col-12 col-lg-3 adress_lo">
            <div class="row">
              <div class="col-12">
                <p>ÖFFNUNGSZEITEN</p>
                <p>MI</p>
                <p>11:00 - 23:00</p>
                <p>MITTWOCH 11:00 bis 23:00</p>
                <p>DO</p>
                <p>11:00 - 23:00</p>
                <p>DONNERSTAG 11:00 bis 23:00</p>
                <p>FR</p>
                <p>11:00 - 23:00</p>
                <p>FREITAG 11:00 bis 23:00</p>
                <p>SA</p>
                <p>11:00 - 23:00</p>
                <p>SAMSTAG 11:00 bis 23:00</p>
                <p>SO</p>
                <p>11:00 - 23:00</p>
                <p>SONNTAG 11:00 bis 23:00</p>
                <p>MO</p>
                <p>11:00 - 23:00</p>
                <p>MONTAG 11:00 bis 23:00</p>
                <p>DI</p>
                <p>11:00 - 23:00</p>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-6 carousel_lo carousel_lo_2">
                <div class="owl-carousel owl-theme">
                  <div class="item"> <img src="{{url('/')}}/frontend/img/location_1.jpg" class="img-fluid mx-auto d-block"> </div>
                  <div class="item"> <img src="{{url('/')}}/frontend/img/location_1.jpg" class="img-fluid mx-auto d-block"> </div>
                  <div class="item"> <img src="{{url('/')}}/frontend/img/location_1.jpg" class="img-fluid mx-auto d-block"> </div>
                </div>
          </div>
      </div>
    </div>
    <!-- /.Loaction 2 -->

    <!-- Loaction 3 -->
    <div class="container-fluid" id="location_main_2">
      <div class="row location_2_lo">
        <div class="col-12 col-lg-6 carousel_lo carousel_lo_3">
            <div class="owl-carousel owl-theme">
              <div class="item"> <img src="{{url('/')}}/frontend/img/location_1.jpg" class="img-fluid mx-auto d-block"> </div>
              <div class="item"> <img src="{{url('/')}}/frontend/img/location_1.jpg" class="img-fluid mx-auto d-block"> </div>
              <div class="item"> <img src="{{url('/')}}/frontend/img/location_1.jpg" class="img-fluid mx-auto d-block"> </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 city_lo">
            <div class="row">
              <div class="col-6">
                <h1>FULDA</h1>
              </div>
              <div class="col-6">
                <p>DARMSTADT SÜD (DE)</p>
                <p>Bessunger Straße 122,</p>
                <p>64285 Darmstadt</p>
                <br>
                <p>TEL.: +49 (6151) 60 40 40</p>
              </div>
            </div>
            <div class="row">
                <div class="col-12 einkaufen_pch einkaufen_chtp einkaufen_lo">
                    <button type="button" class="btn btn-primary btn_lo_ein">{{ __('frontend_cart.einkaufen') }}</button>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 adress_lo">
          <div class="row">
            <div class="col-12">
              <p>ÖFFNUNGSZEITEN</p>
              <p>MI</p>
              <p>11:00 - 23:00</p>
              <p>MITTWOCH 11:00 bis 23:00</p>
              <p>DO</p>
              <p>11:00 - 23:00</p>
              <p>DONNERSTAG 11:00 bis 23:00</p>
              <p>FR</p>
              <p>11:00 - 23:00</p>
              <p>FREITAG 11:00 bis 23:00</p>
              <p>SA</p>
              <p>11:00 - 23:00</p>
              <p>SAMSTAG 11:00 bis 23:00</p>
              <p>SO</p>
              <p>11:00 - 23:00</p>
              <p>SONNTAG 11:00 bis 23:00</p>
              <p>MO</p>
              <p>11:00 - 23:00</p>
              <p>MONTAG 11:00 bis 23:00</p>
              <p>DI</p>
              <p>11:00 - 23:00</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Loaction 3 -->
@endsection

@section('scripts')


@endsection
