<!-- footer content -->
        <!-- <footer>
          <div class="pull-right">
           Your Dashboard by <a href="https://rolandalla.com">Roland Alla</a>
          </div>
          <div class="clearfix"></div>
        </footer> -->
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ URL::asset('/backend/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ URL::asset('/backend/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('/backend/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ URL::asset('/backend/vendors/nprogress/nprogress.js') }}"></script>
    <script src="{{ URL::asset('/backend/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ URL::asset('/backend/vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ URL::asset('/backend/production/js/moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('/backend/production/js/datepicker/daterangepicker.js') }}"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="{{ URL::asset('/backend/build/js/custom.min.js ') }}"></script>
    <script src="{{ URL::asset('/frontend/js/toastr.js') }}"></script>
    <!-- datatables -->
    <script src="{{ URL::asset('/backend/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('/backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>

    <script type="text/javascript">
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
    </script>
    @include('frontLayout.sessions')
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
    <script src="{{ URL::asset('/js/app.js') }}"></script> 

    <script>
    var userId = {{Sentinel::getUser()->id}};
    Echo.private(`App.User.`+userId)
        .notification((notification) => {
           
            ShowShongNow();
            UpdatedNoficationCount();
            AddNewHtmlTO(notification);

        });

    function ShowShongNow() {
        // Play audio
        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', '{{ asset('/backend/vendors/socket/airport_bell.mp3') }}');
        audioElement.setAttribute('autoplay', 'autoplay');
        //audioElement.load()
        $.get();
        audioElement.addEventListener("load", function() {
        audioElement.play();
        }, true);

        audioElement.play();
    }
    function UpdatedNoficationCount() {
       $('#count_notification').text(parseInt($('#count_notification').text()) + parseInt(1));
    }
    function AddNewHtmlTO(notification) {
         // console.log(notification.user.first_name);


        var new_order_even='<li>\
                          <a href="{{ url('notification') }}">\
                            <span class="image"><img src="{{url('/')}}'+notification.user.path+''+notification.user.avatar+'" alt="Profile Image" /></span>\
                            <span>\
                              <span>  '+notification.user.first_name+'  '+notification.user.last_name+'</span>\
                              <span class="time">Requested Delivery: '+notification.date_delivery+' </span>\
                            </span>\
                            <span class="message">\
                             Total:  <strong>'+notification.total+'</strong> {{$appsettings->currency}} <br>  \
                            </span>\
                            </a>\
                        </li>';
      $('.real_new').prepend(new_order_even);
    }

    </script>


    @yield('scripts')
  </body>
</html>