@extends('backLayout.app')
@section('title')
Attribute
@stop

@section('content')

    <h1>{{ __('bck_attribute.Attribute') }} <a href="{{ url('attribute/create') }}" class="btn btn-primary pull-right btn-sm">{{ __('bck_attribute.Add_New_Attribute') }}</a></h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tblattribute">
            <thead>
                <tr>
                    <th>{{ __('bck_attribute.ID') }}</th><th>{{ __('bck_attribute.Name') }}</th><th>{{ __('bck_attribute.Actions') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($attribute as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('attribute', $item->id) }}">{{ $item->name }}</a></td>
                    <td>
                        <a href="{{ url('attribute/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">{{ __('bck_attribute.Update') }}</a>
                        {!! Form::open([
                            'method'=> 'DELETE',
                            'url' => ['attribute', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit( __('bck_attribute.Delete') , ['class' => 'btn btn-danger btn-xs']) !!}
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
        $('#tblattribute').DataTable({
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
