
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
     <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png" href="{{url('/')}}/frontend/favicon.png"/>
    <link rel="apple-touch-icon" sizes="57x57" href="{{url('/')}}/frontend/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="{{url('/')}}/frontend/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="{{url('/')}}/frontend/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="{{url('/')}}/frontend/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="{{url('/')}}/frontend/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="{{url('/')}}/frontend/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="{{url('/')}}/frontend/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="{{url('/')}}/frontend/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="{{url('/')}}/frontend/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="{{url('/')}}/frontend/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="{{url('/')}}/frontend/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="{{url('/')}}/frontend/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="{{url('/')}}/frontend/favicon/favicon-16x16.png">
	<link rel="manifest" href="{{url('/')}}/frontend/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="{{url('/')}}/frontend/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
    <title>PizzaDays | @yield('title') </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('/frontend/css/bootstrap.min.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ URL::asset('/frontend/css/style.css') }}?v=18">

    <link rel="stylesheet" href="{{ URL::asset('/frontend/css/toastr.css') }}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ URL::asset('/frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/frontend/css/owl.theme.default.min.css') }}">
    <!-- Fonts Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('/frontend/css/font-awesome.min.css') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">
    @yield('style')

  </head>
  <body>
	<!-- Header -->
	<div class="container-fluid py-4 header" id="header_index">
	      <div class="row row_header_index">
	         <div class="col col_header_first">
	            <a href="{{url('/')}}"><img src="{{url('/')}}/frontend/img/3.png" class="img-fluid float-left"></a>
	         </div>
	         <div class="col-6 col_header_second">
	            <a href="{{url('/')}}"> <img src="{{url('/')}}/frontend/img/WEBi.png" class="img-fluid mx-auto d-block"> </a>
	         </div>
	         <div class="col col_header_third">
	          <a href="{{url('cart')}}">
                <img src="{{url('/')}}/frontend/img/WEB111.png" class="img-fluid float-right package_store">
                <span class="badge badge-danger float-right badge_price_total">{{(!Sentinel::guest())?$MyCartTotal:'0.00'}} {{$appsettings->currency}}</span>
              </a>
             </div>
	      </div>
	</div>
	<!-- /.Header -->
