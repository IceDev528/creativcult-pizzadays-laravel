@extends('backLayout.app')
@section('title')
{{ __('bck_product.Product') }}
@stop

@section('content')

    <h1>{{ __('bck_product.Product') }}
    @if (Sentinel::getUser()->hasAccess(['product.create']))
    <a href="{{ url('product/create') }}" class="btn btn-primary pull-right btn-sm">{{ __('bck_product.Add_New_Product') }}</a>
    @endif
    </h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tblproduct">
            <thead>
                <tr>
                    <th>{{ __('bck_attribute.ID') }}</th><th>{{ __('bck_product.Image') }}</th>
                     <th>{{ __('bck_attribute.Name') }}</th>
                     <th>{{ __('bck_category.Slug') }}</th>
                    <th>{{ __('bck_category.Category') }}</th>
                    <th>{{ __('bck_attribute.Attributes') }}</th>
                    <th>{{ __('bck_category.Actions') }}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($product as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td> <img src="{{$item->path.'thumb_'.$item->image}}" alt="" style="max-width:150px"></td>
                    <td><a href="{{ url('product', $item->id) }}" >{{ $item->name }}</a></td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>
                        <ol>
                        @forelse ($item->attribute as $atribute)
                            <li>{{ $atribute->name }} <strong>{{ $atribute->pivot->price }}</strong></li>
                        @empty
                            <li>{{ __('bck_product.No_Atribute') }}</li>
                        @endforelse
                        </ul>

                    </td>
                    <td>
                         @if (Sentinel::getUser()->hasAccess(['product.update']))
                        <a href="{{ url('product/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">{{ __('bck_product.Update') }}</a>
                        @endif
                         @if (Sentinel::getUser()->hasAccess(['product.delete']))
                        {!! Form::open([
                            'method'=> 'DELETE',
                            'url' => ['product', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::submit( __('bck_order.delete'), ['class' => 'btn btn-danger btn-xs']) !!}
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
        $('#tblproduct').DataTable({
            responsive:true,
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
