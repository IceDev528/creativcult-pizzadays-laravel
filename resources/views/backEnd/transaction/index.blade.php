@extends('backLayout.app')
@section('title')
Transaction
@stop

@section('content')

    <h1>Transaction <a href="{{ url('transaction/create') }}" class="btn btn-primary pull-right btn-sm">Add New Transaction</a></h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tbltransaction">
            <thead>
                <tr>
                    <th>ID</th><th>Cart Id</th><th>Transaction Id</th><th>Method</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($transaction as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('transaction', $item->id) }}">{{ $item->cart_id }}</a></td><td>{{ $item->transaction_id }}</td><td>{{ $item->method }}</td>
                    <td>
                        <a href="{{ url('transaction/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a> 
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['transaction', $item->id],
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
        $('#tbltransaction').DataTable({
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