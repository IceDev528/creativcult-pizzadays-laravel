@extends('backLayout.app')
@section('title')
{{ __('bck_category.Category') }}
@stop

@section('content')

    <h1>{{ __('bck_category.Category') }} <a href="{{ url('category/create') }}" class="btn btn-primary pull-right btn-sm">{{ __('bck_category.Add_New_Category') }}</a></h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tblcategory">
            <thead>
                <tr>
                    <th>{{ __('bck_attribute.ID') }}</th><th>{{ __('bck_attribute.Name') }}</th><th>{{ __('bck_category.Slug') }}</th><th>{{ __('bck_category.Parent') }}</th><th>{{ __('bck_category.Actions') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($category as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('category', $item->id) }}">{{ $item->name }}</a></td><td>{{ $item->slug }}</td><td>{{ ($item->is_parent)?'--------':$item->parent->name }}</td>
                    <td>
                        <a href="{{ url('category/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a>
                        {!! Form::open([
                            'method'=> 'DELETE',
                            'url' => ['category', $item->id],
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
        $('#tblcategory').DataTable({
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
