@extends('backLayout.app')
@section('title')
{{ __('bck_roles.User_role') }}
@stop

@section('content')
<div class="panel panel-default">
<div class="panel-heading">{{ __('bck_roles.User_role') }}</div>
<div class="panel-body">
    <a href="{{ url('role/create') }}" class="btn btn-success">{{ __('bck_roles.New_role') }}</a>
    <div class="table">
        <table class="table table-bordered table-striped table-hover" id="tblroles">
            <thead>
                <tr>
                    <th>ID</th><th>{{ __('bck_roles.Slug') }}</th><th>{{ __('bck_roles.Name') }}</th><th>{{ __('bck_roles.Action') }}</th>
                </tr>
            </thead>
            <tbody>

            @foreach($roles as $item)

                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('role', $item->id) }}">{{ $item->slug }}</a></td><td>{{ $item->name }}</td>
                    <td>
                     <a href="{{route('user.index',['type='.$item->name])}}" class="btn btn-success btn-xs">{{ __('bck_roles.View_Users') }}</a>
                        <a href="{{ url('role/' . $item->id . '/edit') }}" class="btn btn-success btn-xs">{{ __('bck_roles.Edit') }}</a>
                        <a href="{{ url('role/' . $item->id . '/permissions') }}" class="btn btn-warning btn-xs">{{ __('bck_roles.Perrmissions') }}</a>
                        {!! Form::open([
                            'method'=> 'DELETE',
                            'url' => ['role', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit( __('bck_roles.Delete'), ['class' => 'btn btn-danger btn-xs deleteconfirm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tblroles').DataTable({
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
     $(".deleteconfirm").on("click", function(){
            return confirm("Are you sure to delete this Role");
        });
    </script>
@endsection
