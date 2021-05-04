@extends('backLayout.app')
@section('title')
Carts 
@stop

@section('content')

    <h1>All Carts <!-- <a href="{{ url('cartcheck/create') }}" class="btn btn-primary pull-right btn-sm">Add New Cartcheck</a> --></h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tblcartcheck">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Favourite</th>
                    <th>Favourite Name</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
            @foreach($cartcheck as $item)
                <tr>
                    <td>{{ $item->id }}</td>

                    <td><a href="{{ url('user', $item->user_id) }}">{{ $item->user->first_name }} {{ $item->user->last_name }}</a></td>
                    <td>{{ $item->favourite }}</td>
                    <td>{{ $item->favourite_name }}</td>
                    <td>{{ $item->status_text }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>

                    <td>
                        @if (Sentinel::getUser()->hasAccess(['cartcheck.update']))
                        <a href="{{ url('cartcheck/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a> 
                        @endif
                        @if (Sentinel::getUser()->hasAccess(['cartcheck.delete']))
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['cartcheck', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
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
        $('#tblcartcheck').DataTable({
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