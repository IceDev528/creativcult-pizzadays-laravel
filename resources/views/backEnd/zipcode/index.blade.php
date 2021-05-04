@extends('backLayout.app')
@section('title')
{{ __('bck_users.Zipcode') }}
@stop

@section('content')

    <h1>{{ __('bck_users.Zipcode') }} <a href="{{ url('zipcode/create') }}" class="btn btn-primary pull-right btn-sm">{{ __('bck_users.Add_New_Zipcode') }}</a></h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tblzipcode">
            <thead>
                <tr>
                    <th>ID</th><th>{{ __('bck_users.Number') }}</th><th>{{ __('bck_users.Location') }}</th><th>{{ __('bck_users.Actions') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($zipcode as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('zipcode', $item->id) }}">{{ $item->name }}</a></td><td>{{ $item->location->name }}</td>
                    <td>
                        <a href="{{ url('zipcode/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">{{ __('bck_users.Update') }}</a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['zipcode', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                        {!! Form::close() !!}
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
        $('#tblzipcode').DataTable({
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
