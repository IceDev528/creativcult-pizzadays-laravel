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
    @if($zipcodes)
    @foreach( $zipcodes as $zipcode)
        @foreach($zipcode->users as $user)
            <tr>
                <td>{{ Form::checkbox('sel', $user->id, null, ['class' => ''])}}</td>
                <td>{{$user->id}}</td>
                <td><a href="{{route('user.show', $user->id)}}">{{$user->first_name}}</a></td>
                <td><a href="{{route('user.show', $user->id)}}">{{$user->last_name}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{($user->zipcode)?$user->zipcode->name:'Empty'}}</td>
               <td>{{($user->zipcode)?$user->zipcode->location->name:'Empty'}}</td>
                <td> <a href="{{route('user.index',['type='.$user->roles()->first()->name])}}">{{empty($user->roles()->first())?"":$user->roles()->first()->name}}</a>  </td>
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
      @endforeach
      @endif
    </tbody>
</table>

</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        table = $('#tblUsers').DataTable({
          responsive:true,
            'columnDefs': [{
         'targets': 0,

         'searchable':false,
         'orderable':false,
            }],
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
          'order': [1, 'asc']
            });
    });

</script>
@endsection
