
<div class="left_col scroll-view">
  <div class="navbar nav_title" style="border: 0;">
    <a href="{{url('dashboard')}}" class="site_title"><i class="fa fa-sliders"></i> <span>Pizza Days</span></a>
  </div>

  <div class="clearfix"></div>

  <!-- menu profile quick info -->
  <div class="profile">
    <div class="profile_pic">
      <img src="{{url('/').Sentinel::getUser()->path.Sentinel::getUser()->avatar}}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
      <span> {{__('navigation.welcome')}}</span>
      <h2>{{Sentinel::getUser()->first_name.' ' .Sentinel::getUser()->last_name }}</h2>
    </div>
  </div>
  <!-- /menu profile quick info -->

  <br />

  <!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3> {{__('navigation.your_dashboard')}}</h3>
      <ul class="nav side-menu">
      @if (Sentinel::getUser()->hasAnyAccess(['home.dashboard']))
       <li><a href="{{route('home.dashboard')}}" > <i class="fa fa-area-chart"></i> {{__('navigation.dashboard')}}</a></li>
      @endif
      @if (Sentinel::getUser()->hasAnyAccess(['user.*']))
        <li><a><i class="fa fa-users"></i> {{__('navigation.users')}} <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if (Sentinel::getUser()->hasAnyAccess(['user.index']))
            <li><a href="{{route('user.index')}}"> {{__('navigation.users_all')}}</a></li>
            @endif
            @if (Sentinel::getUser()->hasAnyAccess(['user.create']))
            <li><a href="{{route('user.create')}}"> {{__('navigation.create_new')}}</a></li>
            @endif
          </ul>
        </li>
      @endif

      @if (Sentinel::getUser()->hasAnyAccess(['role.*']))
        <li><a><i class="fa fa-cog"></i> {{__('navigation.Roles')}} <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('role.index')}}">{{__('navigation.all_roles')}} </a></li>
            <li><a href="{{route('role.create')}}">{{__('navigation.create_new')}}</a></li>
          </ul>
        </li>
      @endif
      @if (Sentinel::getUser()->hasAnyAccess(['location.*']))
        <li><a><i class="fa fa-map"></i> {{__('navigation.Locations')}} <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('location.index')}}">{{__('navigation.All_Locations')}}</a></li>
            <li><a href="{{route('location.create')}}">{{__('navigation.create_new')}}</a></li>
          </ul>
        </li>
      @endif
      @if (Sentinel::getUser()->hasAnyAccess(['zipcode.*']))
        <li><a><i class="fa fa-map-marker"></i>  {{__('navigation.Postleitzahlen')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('zipcode.index')}}">{{__('navigation.Postleitzahlen_all')}}</a></li>
            <li><a href="{{route('zipcode.create')}}">{{__('navigation.create_new')}}</a></li>
          </ul>
        </li>
      @endif
      @if (Sentinel::getUser()->hasAnyAccess(['category.*']))
        <li><a><i class="fa fa-sitemap"></i> {{__('navigation.Categories')}} <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('category.index')}}">{{__('navigation.Categories_all')}}</a></li>
            <li><a href="{{route('category.create')}}">{{__('navigation.create_new')}}</a></li>
          </ul>
        </li>
      @endif
      @if (Sentinel::getUser()->hasAnyAccess(['attribute.*']))
        <li><a><i class="fa fa-random"></i> {{__('navigation.Attributes')}} <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('attribute.index')}}">{{__('navigation.Attributes_all')}}</a></li>
            <li><a href="{{route('attribute.create')}}">{{__('navigation.create_new')}}</a></li>
          </ul>
        </li>
      @endif
      @if (Sentinel::getUser()->hasAnyAccess(['product.*']))
        <li><a><i class="fa fa-cutlery"></i> {{__('navigation.Products')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if (Sentinel::getUser()->hasAccess(['product.index']))
            <li><a href="{{route('product.index')}}" >{{__('navigation.Products_all')}}</a></li>
            @endif
            @if (Sentinel::getUser()->hasAccess(['product.create']))
            <li><a href="{{route('product.create')}}">{{__('navigation.create_new')}}</a></li>
            @endif
          </ul>
        </li>
      @endif
      @if (Sentinel::getUser()->hasAnyAccess(['cartcheck.*']))
       <li><a href="{{route('cartcheck.index')}}" > <i class="fa fa-shopping-cart"></i> {{__('navigation.Carts_all')}}</a></li>
      @endif
      @if (Sentinel::getUser()->hasAnyAccess(['order.*']))
       <li><a href="{{route('order.index')}}" > <i class="fa fa-line-chart"></i> {{__('navigation.Orders_all')}}</a></li>
      @endif

      @if (Sentinel::getUser()->hasAnyAccess(['voucher.*']))
        <li><a><i class="fa fa-ticket"></i> {{__('navigation.vouchers')}} <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('voucher.index')}}">{{__('navigation.vouchers_all')}}</a></li>
            <li><a href="{{route('voucher.create')}}">{{__('navigation.create_new')}}</a></li>
          </ul>
        </li>
      @endif
     
        <!-- <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="form.html">General Form</a></li>
            <li><a href="form_advanced.html">Advanced Components</a></li>
            <li><a href="form_validation.html">Form Validation</a></li>
            <li><a href="form_wizards.html">Form Wizard</a></li>
            <li><a href="form_upload.html">Form Upload</a></li>
            <li><a href="form_buttons.html">Form Buttons</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="general_elements.html">General Elements</a></li>
            <li><a href="media_gallery.html">Media Gallery</a></li>
            <li><a href="typography.html">Typography</a></li>
            <li><a href="icons.html">Icons</a></li>
            <li><a href="glyphicons.html">Glyphicons</a></li>
            <li><a href="widgets.html">Widgets</a></li>
            <li><a href="invoice.html">Invoice</a></li>
            <li><a href="inbox.html">Inbox</a></li>
            <li><a href="calendar.html">Calendar</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="tables.html">Tables</a></li>
            <li><a href="tables_dynamic.html">Table Dynamic</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="chartjs.html">Chart JS</a></li>
            <li><a href="chartjs2.html">Chart JS2</a></li>
            <li><a href="morisjs.html">Moris JS</a></li>
            <li><a href="echarts.html">ECharts</a></li>
            <li><a href="other_charts.html">Other Charts</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
            <li><a href="fixed_footer.html">Fixed Footer</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="menu_section">
      <h3>Live On</h3>
      <ul class="nav side-menu">
        <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="e_commerce.html">E-commerce</a></li>
            <li><a href="projects.html">Projects</a></li>
            <li><a href="project_detail.html">Project Detail</a></li>
            <li><a href="contacts.html">Contacts</a></li>
            <li><a href="profile.html">Profile</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="page_403.html">403 Error</a></li>
            <li><a href="page_404.html">404 Error</a></li>
            <li><a href="page_500.html">500 Error</a></li>
            <li><a href="plain_page.html">Plain Page</a></li>
            <li><a href="login.html">Login Page</a></li>
            <li><a href="pricing_tables.html">Pricing Tables</a></li>
          </ul>
        </li>
        <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
              <li><a href="#level1_1">Level One</a>
              <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li class="sub_menu"><a href="level2.html">Level Two</a>
                  </li>
                  <li><a href="#level2_1">Level Two</a>
                  </li>
                  <li><a href="#level2_2">Level Two</a>
                  </li>
                </ul>
              </li>
              <li><a href="#level1_2">Level One</a>
              </li>
          </ul>
        </li>                  
        <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li> -->
      </ul>
    </div>

  </div>
  <!-- /sidebar menu -->
@if (Sentinel::getUser()->hasAnyAccess(['appsetting.*']))
  <!-- /menu footer buttons -->
  <div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" href="{{route('appsetting.index')}}" title="Settings">
      <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <!-- <a data-toggle="tooltip" data-placement="top" title="FullScreen">
      <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
      <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout">
      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a> -->
  </div>
  <!-- /menu footer buttons -->
  @endif
</div>
