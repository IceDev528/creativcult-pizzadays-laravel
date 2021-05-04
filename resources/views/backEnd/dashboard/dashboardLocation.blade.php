
@extends('backLayout.app')
@section('title')
 {{ __('bck_dashboard.title') }} {{Sentinel::getUser()->location->name}}
@stop

@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.3/css/buttons.dataTables.min.css"/ >
@stop
@section('content')

<div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i>  {{ __('bck_dashboard.Total') }}  {{Sentinel::getUser()->location->name}} Users</span>
              <div class="count">{{$totalUsers}}</div>
              <!-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-cutlery"></i>  {{ __('bck_dashboard.Total_Products') }}</span>
              <div class="count">{{$totalProducts}}</div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span> -->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-shopping-cart"></i> {{ __('bck_dashboard.Today_Carts') }}</span>
              <div class="count">{{$todayCountCarts}}</div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-cart-arrow-down"></i> {{ __('bck_dashboard.Today_Orders_On') }} {{Sentinel::getUser()->location->name}}</span>
              <div class="count">{{$todayCountOrders}}</div>
              <!-- <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span> -->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i>{{ __('bck_dashboard.Today_total_value') }}</span>
              <div class="count">{{$todaySumvalue}} {{$appsettings->currency}}</div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-line-chart"></i>{{ __('bck_dashboard.Total_value') }}</span>
              <div class="count green">{{$ordersSumvalue}} {{$appsettings->currency}}</div>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
            </div>
</div>
<!-- /top tiles -->

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="dashboard_graph">
     <div class="col-md-9 col-sm-9 col-xs-12">
      <div class="row">
          <div class="col-md-6">
            <h3>{{ __('bck_dashboard.Orders_Activities') }} <small>{{ __('bck_dashboard.List_all_activities') }}</small></h3>
          </div>
          <div class="col-md-6">
            <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
              <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
              <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
            </div>
          </div>
        </div>
        <div class="x_content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ __('bck_dashboard.Custom_Search') }} </h3>
            </div>
            <div class="panel-body">
                <form  id="search-form"  class="form-inline" role="form">

                    <div class="form-group">
                        <label for="name">{{ __('bck_dashboard.Search') }}</label>
                        <input type="text" class="form-control" name="name" id="search_name" placeholder="{{ __('bck_dashboard.by_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('bck_dashboard.Or') }}</label>
                        <input type="text" class="form-control" name="email" id="search_email" placeholder="{{ __('bck_dashboard.by_email') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">{{ __('bck_dashboard.Or') }}</label>
                        <input type="text" class="form-control" name="methode" id="search_methode" placeholder="{{ __('bck_dashboard.by_payment_methode') }}">
                    </div>
                    

                    <button type="submit" class="btn btn-primary">{{ __('bck_dashboard.Search') }}</button>
                </form>
            </div>
        </div>

          <table id="tableOrder-dashboard" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                  <th>{{ __('bck_order.ID') }}</th>
                  <th>{{ __('bck_order.User_Name') }}</th>
                  <th>{{ __('bck_order.Method') }}</th>
                  <th>{{ __('bck_order.Delivery_Date') }}</th>
                  <th>{{ __('bck_order.Total') }}</th>
                  <th>{{ __('bck_order.Status') }}</th>
                  <th>{{ __('bck_order.Actions') }}</th>
              </tr>
          </thead>
          <tfoot>
            <tr>
                <th colspan="4" style="text-align:right">{{ __('bck_dashboard.Total_value') }}</th>
                <th></th>
            </tr>
        </tfoot>
          
          </table>
        </div>
      </div>
      <!-- Start to do list -->
      <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="row" style="height: 45px">
            
        </div>
        <div class="x_panel">
          <div class="x_title">
            <h2>{{ __('bck_dashboard.to_Day_after') }} {{\Carbon\Carbon::now('Europe/Berlin')}}</h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div class="">
              <ul class="to_do">
                
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- End to do list -->

      <div class="clearfix"></div>
    </div>
  </div>

</div>
<br />


@endsection

@section('scripts')
<script src="https://cdn.datatables.net/buttons/1.2.3/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.3/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.3/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.3/js/buttons.print.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.15/api/sum().js"></script>
<script type="text/javascript">
  $(document).ready(function(){
            var startdata='';
            var enddata='';

              datetimePicker();
              getToDoSection(); //Call to To ajax
            var oTable = $('#tableOrder-dashboard').DataTable({
                    dom: 'lrtipB',
                    searching: true,
                     language:{
                              "sEmptyTable":      "Keine Daten in der Tabelle vorhanden",
                              "sInfo":            "_START_ bis _END_ von _TOTAL_ Einträgen",
                              "sInfoEmpty":       "0 bis 0 von 0 Einträgen",
                              "sInfoFiltered":    "(gefiltert von _MAX_ Einträgen)",
                              "sInfoPostFix":     "",
                              "sInfoThousands":   ".",
                              "sLengthMenu":      "_MENU_ Einträge anzeigen",
                              "sLoadingRecords":  "Wird geladen...",
                              "sProcessing":      "Bitte warten...",
                              "sSearch":          "Suchen",
                              "sZeroRecords":     "Keine Einträge vorhanden.",
                              "oPaginate": {
                                  "sFirst":       "Erste",
                                  "sPrevious":    "Zurück",
                                  "sNext":        "Nächste",
                                  "sLast":        "Letzte"
                              },
                              "oAria": {
                                  "sSortAscending":  ": aktivieren, um Spalte aufsteigend zu sortieren",
                                  "sSortDescending": ": aktivieren, um Spalte absteigend zu sortieren"
                              }
                          },
                    paging: true,
                    processing: true,
                    serverSide: true,
                     // order: [[ 3, "asc" ]],
                    deferRender: true,
                    lengthMenu: [[5, 15, 20, 50,100,200, -1],[5, 15, 20, 50,100,200, "All"]],
                    pageLength: 50,        
                    responsive: true,
                    ajax: {
                        url: '{{action('HomeController@OrderStatistics')}}',
                        method: 'POST',
                        data: function (d) {
                            d.startDate = startdata;
                            d.endDate = enddata;
                             d.name = $('#search_name').val();
                             d.email = $('#search_email').val();
                             d.methode = $('#search_methode').val();
                        }
                    },
                    columns: [
                        { data: 'id', name: 'id'},
                        { data: 'full_name', name: 'full_name'},
                        { data: 'method', name: 'method'},
                        { data: 'date_delivery', name: 'date_delivery'},
                        { data: 'total', name: 'total'},
                         { data: 'status_text', name: 'status_text'},
                        {
                                data: 'actions',
                                data: null,
                                sortable: false,
                                searchable: false,
                                render: function (data) {
                                    var actions = '';
                                    actions += (data.status >0)?'<a href="{{ route('order.StatusEnableDesable', ':id') }}" data-toggle="tooltip" title="{{ __('bck_dashboard.Mark_as_not_completed') }}"  class="confirm_status"><span class="glyphicon glyphicon-ok-sign icon_status green"></span></a>':'<a href="{{ route('order.StatusEnableDesable', ':id') }}" data-toggle="tooltip" title="{{ __('bck_dashboard.Mark_as_completed') }}" class="confirm_status" ><span class="glyphicon glyphicon-minus-sign icon_status red"></span></a>';
                                    actions += '<a href="{{ route('order.show', ':id') }}" class=" btn btn-default btn-small btn-primary">{{ __('bck_dashboard.show') }}</a>';
                                    actions += '<a href="{{ route('order.edit', ':id') }}" class=" btn btn-default btn-small btn-info" >{{ __('bck_dashboard.edit') }}</a>';
                                    
                                    return actions.replace(/:id/g, data.id);
                                }
                            },
                    ],
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    footerCallback: function ( row, data, start, end, display ) {
                        // var api = this.api();
                          var api = this.api(), data;
                          var json = api.ajax.json();
                 
                            // Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '')*1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
                 
                            // Total over all pages
                            total = json.total;
                 
                            // Total over this page
                            pageTotal = api
                                .column( 4, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                            // Update footer
                            $( api.column( 4 ).footer() ).html(
                                pageTotal.toFixed(2) +' {{$appsettings->currency}} (' +total.toFixed(2) +' {{$appsettings->currency}} total)'
                            );

                        // $('#show_subtotal').html(json.total_price.toFixed(4) +' €');
                        // $('#show_vat').html(json.all_total_tax.toFixed(4) +' €');
                        // $('#show_total').html((json.total_price+json.all_total_tax).toFixed(4) +' €');
                    },
                    // initComplete: function () {
                    //     this.api().columns([1,2,3,4,5]).every(function () {
                    //         var column = this;
                    //         var input = document.createElement("input");
                    //         $(input).appendTo($(column.footer()).empty())
                    //         .on('change', function () {
                    //             column.search($(this).val(), false, false, true).draw();
                    //         });
                    //     });
                    // }
                    
                });
              

            
          function datetimePicker() {
                   var cb = function(start, end, label) {
                      // console.log(start.toISOString(), end.toISOString(), label);
                      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    };

                    var optionSet1 = {
                      startDate: moment().subtract(29, 'days'),
                      endDate: moment(),
                      minDate: '01/01/2017',
                      maxDate: '12/31/2017',
                      dateLimit: {
                        days: 60
                      },
                      showDropdowns: true,
                      showWeekNumbers: true,
                      timePicker: false,
                      timePickerIncrement: 1,
                      timePicker12Hour: true,
                      ranges: {
                        '{{ __('bck_dashboard.Today') }}': [moment(), moment()],
                        '{{ __('bck_dashboard.Yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        '{{ __('bck_dashboard.Last_7_Days') }}': [moment().subtract(6, 'days'), moment()],
                        '{{ __('bck_dashboard.Last_30_Days') }}': [moment().subtract(29, 'days'), moment()],
                        '{{ __('bck_dashboard.This_Month') }}': [moment().startOf('month'), moment().endOf('month')],
                        '{{ __('bck_dashboard.Last_Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                      },
                      opens: 'left',
                      buttonClasses: ['btn btn-default'],
                      applyClass: 'btn-small btn-primary',
                      cancelClass: 'btn-small',
                      format: 'MM/DD/YYYY',
                      separator: ' to ',
                      locale: {
                        applyLabel: '{{ __('bck_dashboard.Submit') }}',
                        cancelLabel: '{{ __('bck_dashboard.Clear') }}',
                        fromLabel: '{{ __('bck_dashboard.From') }}',
                        toLabel: '{{ __('bck_dashboard.Today') }}',
                        customRangeLabel: '{{ __('bck_dashboard.Custom') }}',
                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        firstDay: 1
                      }
                    };
                    $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
                    $('#reportrange').daterangepicker(optionSet1, cb);
                    // $('#reportrange').on('show.daterangepicker', function() {
                    //   console.log("show event fired");
                    // });
                    // $('#reportrange').on('hide.daterangepicker', function() {
                    //   console.log("hide event fired");
                    // });
                    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
                      startdata=picker.startDate.format('YYYY-MM-DD');
                      enddata=picker.endDate.format('YYYY-MM-DD');
                      oTable.draw();
                    });
                    // $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
                    //   console.log("cancel event fired");
                    // });
                    $('#options1').click(function() {
                      $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
                    });
                    $('#options2').click(function() {
                      $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
                    });
                    $('#destroy').click(function() {
                      $('#reportrange').data('daterangepicker').remove();
                    });
            }


          //update table on notification
            var userId = {{Sentinel::getUser()->id}};
            Echo.private(`App.User.`+userId)
                .notification((notification) => {
                     startdata=notification.date_refresh;
                     enddata=notification.date_refresh;
                     oTable.draw();
                     getToDoSection();

                });
          //Updated table

          //earch custom fields
           $('#search-form').on('submit', function(e) {
                 e.preventDefault();
                oTable.draw();
               
            });
          //End search

          //Confirm order change status

          $('#tableOrder-dashboard').on('click','.confirm_status',function(event){
                   return confirm('{{ __('bck_dashboard.change_status_message') }}');
                     
          });
          //end confirm

    });


function getToDoSection(){
            $.ajax({
               type:'POST',
               url:'{{action('HomeController@OrderTodayToDoOrders')}}',
               success:function(data){
                    var html=''
                    if (data.success) {

                      $.each(data.orders, function( index, order ) {
                          var status=( order.status >1)?'completed':'pending';
                          html+='<a href="{{ url('order') }}/'+order.id+'">\
                                    <li>\
                                      <p><i class="fa fa-cutlery"></i> <strong>{{ __('bck_dashboard.delivery_date') }} </strong>'+order.date_delivery+' <br /><strong>{{ __('bck_dashboard.order_method') }}</strong> '+order.method+' <br /><strong>{{ __('bck_dashboard.status') }} </strong>'+status+'</p>\
                                  </li>\
                                </a>';
                      });

                       
                    }
                  $(".to_do").html(html);
               }
            });
}




</script>

@endsection