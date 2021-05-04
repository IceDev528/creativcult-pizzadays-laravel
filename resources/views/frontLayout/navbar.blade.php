<!-- Navbar -->
    <nav class="navbar navbar-toggleable-md sticky-top navbar-light bg-faded menu menu--antonio">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand hidden-lg-up" href="{{url('/')}}"><img src="{{url('/')}}/frontend/img/logo1.png" class="img-fluid"></a>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
        <ul class="navbar-nav nav-right menu__list">
          <li class="menu__item menu__item--current"><a href="{{url('/')}}" class="nav-item nav-link menu__link">{{ __('frontend_cart.Home') }}</a></li>
          <li class="menu__item"><a href="{{url('shop/pizza')}}" class="nav-item nav-link menu__link">{{ __('frontend_cart.Pizza') }}</a></li>
          <li class="menu__item"><a href="{{url('shop/pasta')}}" class="nav-item nav-link menu__link">{{ __('frontend_cart.Pasta') }}</a></li>
          <li class="menu__item"><a href="{{url('shop')}}" class="nav-item nav-link menu__link">{{ __('frontend_cart.Abgebot') }}</a></li>
          <li class="menu__item"><a href="{{url('locations')}}" class="nav-item nav-link menu__link">{{ __('frontend_cart.Store') }}</a></li>
          <li class="menu__item"><a href="{{url('about-us')}}" class="nav-item nav-link menu__link">{{ __('frontend_cart.Uber_Uns') }}</a></li>
          @if(Sentinel::guest())
          <li class="menu__item"><a href="{{url('login')}}" class="nav-item nav-link menu__link" id="seventh" data-toggle="modal" data-target="#myModal">{{ __('frontend_cart.Login') }}</a></li>
          <li class="menu__item"><a href="{{url('register')}}" class="nav-item nav-link menu__link" id="seventh">{{ __('frontend_cart.Create_Account') }}</a></li>
          @else
          <li class="menu__item"><a href="{{url('my-account')}}" class="nav-item nav-link menu__link" id="seventh">{{ __('frontend_cart.My_Account') }}</a></li>
          <li class="menu__item"><a href="{{url('user/logout')}}" class="nav-item nav-link menu__link" id="seventh">{{ __('frontend_cart.Logout') }}</a></li>
          @endif
          <li class="menu__item"><a href="#" class="nav-item nav-link menu__link" id="seventh">{{ __('frontend_cart.New_Order') }}</a></li>
        </ul>
        <!--<div class="navbar-nav">
          <ul class="menu__list">
            <li class="menu__item menu__item--current"><a class="nav-item nav-link" href="#">Home <span class="sr-only">(current)</span></a></li>
            <li class="menu__item"><a class="nav-item nav-link menu__link" href="#">Pizza</a></li>
            <li class="menu__item"><a class="nav-item nav-link menu__link" href="#">Pasta</a></li>
            <li class="menu__item"><a class="nav-item nav-link menu__link" href="#">Angebot</a></li>
            <li class="menu__item"><a class="nav-item nav-link menu__link" href="#">Store</a></li>
            <li class="menu__item"><a class="nav-item nav-link menu__link" href="#">Über Uns</a></li>
            <li class="menu__item"><a class="nav-item nav-link menu__link" href="#">Log In</a></li>
            <li class="menu__item"><a class="nav-item nav-link menu__link" href="#">Create Account</a></li>
            <li class="menu__item"><a class="nav-item nav-link menu__link" href="#">New Order</a></li>
          </ul>
        </div>-->
      </div>
    </nav>
    <!-- /.Navbar -->
