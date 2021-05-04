@extends('backLayout.app')
@section('title')
{{ __('bck_order.Order') }}
@stop

@section('content')

<h1>{{ __('bck_order.Order') }} 
@if (Sentinel::getUser()->hasAccess(['order.create']))
<a href="{{ url('order/create') }}" class="btn btn-primary pull-right btn-sm">Add New Order</a>
@endif
</h1>
<div class="table table-responsive">
    <table class="table table-bordered table-striped table-hover" id="tblorder">
        <thead>
            <tr>
                <th></th>
                <th>{{ __('bck_order.ID') }}</th>
                <th>{{ __('bck_order.Cart_Id') }}</th>
                <th>{{ __('bck_order.User_Name') }}</th>
                <th>{{ __('bck_order.Method') }}</th>
                <th>{{ __('bck_order.Status') }}</th>
                <th>{{ __('bck_order.Total') }}</th>
                <th>{{ __('bck_order.Delivery_Date') }}</th>
                <th>{{ __('bck_order.Actions') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($order as $item)
            <tr>
                <td></td>
               <td><a href="{{ url('order', $item->id) }}">{{ $item->id }}</a></td>
                <td><a href="{{ url('cartcheck', $item->cart_id) }}">{{ $item->cart_id }}</a></td>
                <td><a href="{{ url('user', $item->cart->user->id) }}">{{ $item->cart->user->first_name }} {{ $item->cart->user->last_name }}</a></td>
                <td>{{ $item->method }}</td>
                <td>{{ $item->status_text }}</td>
                <td>{{ $item->total }} {{$appsettings->currency}}</td>
                <td>{{ $item->date_delivery }}</td>
                <td>
                @if($item->status >0)
                <a href="{{ route('order.StatusEnableDesable', $item->id) }}" data-toggle="tooltip" title="Mark as not completed" onclick="return confirm(' Sure that you want to change the order status?');" ><span class="glyphicon glyphicon-ok-sign icon_status green"></span></a>
                @else
                <a href="{{ route('order.StatusEnableDesable', $item->id) }}" data-toggle="tooltip" title="Mark as completed" onclick="return confirm(' Sure that you want to change the order status?');"  ><span class="glyphicon glyphicon-minus-sign icon_status red"></span></a>
                @endif
                @if (Sentinel::getUser()->hasAccess(['order.edit']))
                    <a href="{{ url('order/' . $item->id) }}" class="btn btn-success btn-xs">{{ __('bck_users.View') }}</a>
                @endif
                 @if (Sentinel::getUser()->hasAccess(['order.edit']))
                    <a href="{{ url('order/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">{{ __('bck_order.Update') }}</a>
                @endif
                @if (Sentinel::getUser()->hasAccess(['order.delete']))

                    {!! Form::open([
                        'method'=> 'DELETE',
                        'url' => ['order', $item->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::submit( __('bck_order.delete'), ['class' => 'btn btn-danger btn-xs','onclick'=>"return confirm(' you want to delete?');"]) !!}
                    {!! Form::close() !!}
                @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#tblorder').DataTable({
            columnDefs: [{
                targets: [0],
                visible: false,
                searchable: false
                },
            ],
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
            order: [[0, "asc"]],
        });
    });
</script>
@endsection
