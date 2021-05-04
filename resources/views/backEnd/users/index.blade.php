@extends('backLayout.app')
@section('title')
{{ __('bck_users.Users') }}
@stop

@section('content')
<div class="panel panel-default">
        <div class="panel-heading">{{ __('bck_users.Users') }}</div>

        <div class="panel-body">

@if (Sentinel::getUser()->hasAccess(['user.create']))
<a href="{{route('user.create')}}" class="btn btn-success">{{ __('bck_users.New_User') }}</a>
@endif
<table class="table table-bordered table-striped table-hover" id="tblUsers">
    <thead>
        <tr>

            <th>{{ __('bck_users.Select_All') }} <input name="select_all" value="1" id="example-select-all" type="checkbox" /></th>
            <th>{{ __('bck_users.ID') }}</th>
            <th>{{ __('bck_users.First_Name') }}</th>
            <th>{{ __('bck_users.Last_name') }}</th>
            <th>{{ __('bck_users.Email') }}</th>
            <th>{{ __('bck_users.Zip_Code') }}</th>
            <th>{{ __('bck_users.Location') }}</th>
            <th>{{ __('bck_users.User_role') }}</th>
            <th>{{ __('bck_users.Created_At') }}</th>
            <th>{{ __('bck_users.Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ Form::checkbox('sel', $user->id, null, ['class' => ''])}}</td>
                <td>{{$user->id}}</td>
                <td><a href="{{route('user.show', $user->id)}}">{{$user->first_name}}</a></td>
                <td><a href="{{route('user.show', $user->id)}}">{{$user->last_name}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{($user->zipcode)?$user->zipcode->name:'Empty'}}</td>
               <td>{{($user->zipcode)?$user->zipcode->location->name:'Empty'}}</td>
                <td> <a href="{{route('user.index',['type='.$user->roles()->first()->slug])}}">{{empty($user->roles()->first())?"":$user->roles()->first()->name}}</a>  </td>
                <td>{{$user->created_at}}</td>
                <td>
                    @if (Sentinel::getUser()->hasAccess(['user.show']))
                    <a href="{{route('user.show', $user->id)}}" class="btn btn-success btn-xs">{{ __('bck_users.View') }}</a>
                    @endif
                    @if (Sentinel::getUser()->hasAccess(['user.edit']))
                    <a href="{{route('user.edit', $user->id)}}" class="btn btn-success btn-xs">{{ __('bck_users.edit') }}</a>
                    @endif
                    @if (Sentinel::getUser()->hasAccess(['user.permissions']))
                    <a href="{{route('user.permissions', $user->id)}}" class="btn btn-warning btn-xs">{{ __('bck_users.Permissions') }}</a>
                    @endif
                    @if (Sentinel::getUser()->hasAccess(['user.destroy']))
                    {!! Form::open(['method'=>'DELETE', 'route' => ['user.destroy', $user->id], 'style' => 'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs','id'=>'delete-confirm']) !!}
                    {!! Form::close() !!}
                    @endif

                    @if(sizeof($user->activations) == 0)
                    @if (Sentinel::getUser()->hasAccess(['user.activate']))
                    <a href="{{route('user.activate', $user->id)}}" class="btn btn-primary btn-xs">{{ __('bck_users.Activate') }}</a>
                    @endif
                    @else
                    @if (Sentinel::getUser()->hasAccess(['user.deactivate']))
                     <a href="{{route('user.deactivate', $user->id)}}" class="btn btn-warning btn-xs">{{ __('bck_users.Deactivate') }}</a>
                     @endif
                    @endif

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@if (Sentinel::getUser()->hasAccess(['user.destroy']))
<button id="delete_all" class='btn btn-danger btn-xs'>{{ __('bck_users.Delete_Selected') }}</button>
@endif
@if (Sentinel::getUser()->hasAccess(['user.activate']))
<button id="activate_all" class='btn btn-primary btn-xs'>{{ __('bck_users.Activate_Selected') }}</button>
@endif
@if (Sentinel::getUser()->hasAccess(['user.deactivate']))
<button id="deactivate_all" class='btn btn-warning btn-xs'>{{ __('bck_users.Deactivate_Selected') }}</button>
@endif
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        table = $('#tblUsers').DataTable({
          responsive:true,
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
            'columnDefs': [{
         'targets': 0,

         'searchable':false,
         'orderable':false,
            }],
          'order': [1, 'asc']
            });
    });
      // Handle click on "Select all" control
   $('#example-select-all').on('click', function(){
      // Check/uncheck all checkboxes in the table
      var rows = table.rows({ 'search': 'applied' }).nodes();
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });
  $("input#delete-confirm").on("click", function(){
        return confirm("{{ __('bck_users.Are_you_sure_to_delete_this_user') }}");
    });
  // start Delete All function
  $("#delete_all").click(function(event){
        event.preventDefault();
        if (confirm("{{ __('bck_users.Are_you_sure_to_Delete_Selected') }}")) {
            var value=get_Selected_id();
            if (value!='') {

                 $.ajax({
                    type: "POST",
                    cache: false,
                    url : "{{action('UserController@ajax_all')}}",
                    data: {all_id:value,action:'delete'},
                        success: function(data) {
                          location.reload()
                        }
                    })

                }else{return confirm("{{ __('bck_users.You_have_to_select_any_item_before') }}");}
        }
        return false;
   });
  //End Delete All Function
  //Start Deactivate all Function
    $("#deactivate_all").click(function(event){
        event.preventDefault();
        if (confirm("{{ __('bck_users.Are_you_sure_to_Deactivate_Selected') }} ?")) {
            var value=get_Selected_id();
            if (value!='') {

                 $.ajax({
                    type: "POST",
                    cache: false,
                    url : "{{action('UserController@ajax_all')}}",
                    data: {all_id:value,action:'deactivate'},
                        success: function(data) {
                          location.reload()
                        }
                    })

                }else{return confirm("{{ __('bck_users.You_have_to_select_any_item_beforee') }}");}
        }
        return false;
    });
    //End Deactivate Function
      //Start Activate all Function
    $("#activate_all").click(function(event){
        event.preventDefault();
        if (confirm("{{ __('bck_users.Are_you_sure_to_Activate_Selected') }}?")) {
            var value=get_Selected_id();
            if (value!='') {

                 $.ajax({
                    type: "POST",
                    cache: false,
                    url : "{{action('UserController@ajax_all')}}",
                    data: {all_id:value,action:'activate'},
                        success: function(data) {
                          location.reload()
                        }
                    })

                }else{return confirm("{{ __('bck_users.You_have_to_select_any_checkbox_before') }}");}
        }
        return false;
    });
    //End Activate Function




   function get_Selected_id() {
    var searchIDs = $("input[name=sel]:checked").map(function(){
      return $(this).val();
    }).get();
    return searchIDs;
   }
</script>
@endsection
