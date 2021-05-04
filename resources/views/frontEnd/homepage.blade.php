@extends('frontLayout.app')
@section('title')
{{ __('frontend_cart.Login') }}
@stop
@section('content')
<!-- Carousel Home -->
    <div class="container-fluid" id="carousel_home">
      <div class="row">
        <div class="col">
            <div class="owl-carousel owl-theme">
              <div class="item"> <img src="{{url('/')}}/frontend/img/Zeichenfläche-150.png" class="img-fluid mx-auto d-block"> </div>
              <div class="item"> <img src="{{url('/')}}/frontend/img/food-pizza.png" class="img-fluid mx-auto d-block"> </div>
              <div class="item"> <img src="{{url('/')}}/frontend/img/pizzalolo.png" class="img-fluid mx-auto d-block"> </div>
            </div>
        </div>
      </div>
    </div>
    <!-- /.Carousel Home -->

    <!-- Jetzt Probieren -->
    <div class="container-fluid mt-4" id="jetzt">
       <div class="row">
          <div class="col">
            <img src="{{url('/')}}/frontend/img/points.png" class="img-fluid">
          </div>
       </div>
       <div class="row mt-4 content_jetzt">
          <div class="col-lg-6">
             <img src="{{url('/')}}/frontend/img/Zeichenfläche 160.jpg" class="img-fluid mx-auto d-block">
          </div>
          <div class="col-lg-6">
             <div class="row row_second_content">
                <div class="col-lg-12">
                   <img src="{{url('/')}}/frontend/img/Zeichenfläche 170.jpg" class="img-fluid mx-auto d-block">
                </div>
             </div>
             <div class="row row_third_content">
                <div class="col-lg-12">
                   <img src="{{url('/')}}/frontend/img/Zeichenfläche 190.jpg" class="img-fluid mx-auto d-block">
                </div>
             </div>
          </div>
       </div>
    </div>
    <!-- /.Jetzt Probieren -->

    <!-- Produkte -->
    <div class="container-fluid" id="Produkte">
      <div class="row">
        <div class="col">
          <img src="{{url('/')}}/frontend/img/pointsprodukte.png" class="img-fluid">
        </div>
      </div>
      <div class="row mt-4 content_produkte">
        <div class="col">
           <img src="{{url('/')}}/frontend/img/Zeichenfläche 200.jpg" class="img-fluid mx-auto d-block">
        </div>
        <div class="col">
           <img src="{{url('/')}}/frontend/img/zeichenlache.png" class="img-fluid mx-auto d-block">
        </div>
        <div class="col">
           <img src="{{url('/')}}/frontend/img/Zeichenfläche 10.jpg" class="img-fluid mx-auto d-block">
        </div>
      </div>
    </div>
    <!-- /.Produkte -->
@endsection

@section('scripts')


@endsection
