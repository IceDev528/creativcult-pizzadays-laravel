@extends('backLayout.app')
@section('title')
{{ __('bck_location.Location') }}
@stop

@section('content')

    <h1>{{ __('bck_location.Location') }} <a href="{{ url('location/create') }}" class="btn btn-primary pull-right btn-sm">{{ __('bck_location.Add_New_Location') }}</a></h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tbllocation">
            <thead>
                <tr>
                    <th>{{ __('bck_attribute.ID') }}</th>
                    <th>{{ __('bck_attribute.Name') }}</th>
                    <th>{{ __('bck_attribute.User') }}</th>
                    <th>{{ __('bck_attribute.Actions') }}</th>

                </tr>
            </thead>
            <tbody>
            @foreach($location as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('location', $item->id) }}">{{ $item->name }}</a></td>
                    <td><a href="{{ url('user', ($item->manager())?$item->manager()->id:'') }}">{{ ($item->manager())?$item->manager()->email:'' }}</a></td>
                    <td>
                        <a href="{{ url('location/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">{{ __('bck_attribute.Update') }}</a>
                        {!! Form::open([
                            'method'=> 'DELETE',
                            'url' => ['location', $item->id],
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
        $('#tbllocation').DataTable({
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
