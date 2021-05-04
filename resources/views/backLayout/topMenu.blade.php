
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{url('/').Sentinel::getUser()->path.Sentinel::getUser()->avatar}}" alt="">{{Sentinel::getUser()->first_name.' ' .Sentinel::getUser()->last_name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ URL::asset('my-account') }}">   {{__('navigation.Profile')}}</a></li>
                    <!-- <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li> 
                    <li><a href="javascript:;">Help</a></li>-->
                     {!! Form::open(['url' => url('logout'),'class'=>'form-inline']) !!}
                           {!! csrf_field() !!}
                          <li><button class="btn btn-primary btn-lg btn-block register-button" type="submit" >{{__('navigation.Logout')}}</button> </li>
                       {!! Form::close() !!}
                  </ul>
                </li>
                <li>
                  <a href="{{url('/')}}">
                    <i class="fa fa-home" style="font-size: 25px; padding-top: 6px;"></i>
                  </a>
                </li>


                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green" id="count_notification">{{Sentinel::getUser()->unreadNotifications->count()}}</span>
                  </a>
                 
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <div class="real_new">
                      
                    </div>
                   @if(Sentinel::getUser()->unreadNotifications->count()>0)
                    @foreach (Sentinel::getUser()->unreadNotifications as $notification)
                    <?php $data=$notification->data; ?>
                  
                    <li>
                      <a href="{{ url('notification', $notification->id) }}">
                        <span class="image"><img src="{{ url('/').$data['user']['path'].$data['user']['avatar'] }}" alt="Profile Image" /></span>
                        <span>
                          <span>   {{ $data['user']['first_name'].' '.$data['user']['last_name'] }}</span>
                          <span class="time"> {{__('navigation.requested_delivery')}} {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i',$data['date_delivery']) ->diffForHumans(\Carbon\Carbon::now('Europe/Berlin')) }} </span>
                        </span>
                      
                        <span class="message">
                          {{__('navigation.total')}} <strong>{{ $data['total'] }}</strong> {{$appsettings->currency}} <br>  
                        </span>
                        </a>
                    </li>
                    @endforeach
                    <li>
                      <div class="text-center">
                        <a href="{{url('notification?only=unread')}}">
                          <strong> {{__('navigation.See_All_Alerts')}}</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                     @endif
                  </ul>
                 
                </li>
              </ul>
            </nav>