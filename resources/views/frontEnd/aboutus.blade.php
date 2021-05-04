@extends('frontLayout.app')
@section('title')
{{ __('frontend_cart.Uber_Uns') }}
@stop
@section('content')
<!-- Image Header -->
    <div class="container-fluid" id="image_header_pch">
      <div class="row row_image_header_pch">
         <div class="col">
            <img src="{{url('/')}}/frontend/img/uberuns_header.png" class="img-fluid mx-auto d-block" alt="Pizza Days">
         </div>
      </div>
    </div>
    <!-- /.Image Header -->

    <!-- Uber Uns -->
    <div class="container-fluid" id="uber_uns">
      <div class="row row_uu">
        <div class="col-12 text-center title_uu">
          <h1>{{ __('frontend_cart.Uber_Uns') }}</h1>
        </div>
        <div class="col-12 content_uu">
          <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved.
          It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved.</p>
        </div>
      </div>
      <div class="row_uu_1">
        <div class="container-fluid">
          <div class="row justify-content-between">
            <div class="col-4">
              <img src="{{url('/')}}/frontend/img/location_1.jpg" class="img-fluid mx-auto d-block" alt="Pizza Days">
            </div>
            <div class="col-4">
              <img src="{{url('/')}}/frontend/img/location_1.jpg" class="img-fluid mx-auto d-block" alt="Pizza Days">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Uber Uns -->
@endsection

@section('scripts')


@endsection
