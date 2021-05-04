@extends('backLayout.app')
@section('title')
Voucher
@stop

@section('content')

    <h1>Voucher <a href="{{ url('voucher/create') }}" class="btn btn-primary pull-right btn-sm">Add New Voucher</a></h1>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover" id="tblvoucher">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Coupon Type</th>
                    <th>Location</th>
                    <th>Zip Code</th>
                    <th>User</th>
                    <th>Max uses</th>
                    <th>Actually used</th>
                    <th>Total Amount</th>
                    <th>Is Fixed</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($voucher as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ url('voucher', $item->id) }}">{{ $item->code }}</a></td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->voucher_type }}</td>
                    <td>{{ ($item->location)? $item->location->name :'------------' }}</td>
                    <td>{{ ($item->zipcode)?$item->zipcode->name:'------------' }}</td>
                    <td>{{  ($item->user_id)?$item->user->email:'------------'}}</td>
                    <td>{{ $item->max_uses }}</td>
                    <td>{{ $item->uses }}</td>
                    <td>{{ $item->discount_amount }}</td>
                    <td>{{ ($item->is_fixed >0)?'Yes':'is in %' }}</td>
                    <td>{{ $item->starts_at }}</td>
                    <td>{{ $item->expires_at }}</td>
                    <td>
                        <a href="{{ url('voucher/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Update</a> 
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['voucher', $item->id],
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
        $('#tblvoucher').DataTable({
            columnDefs: [{
                targets: [0],
                visible: false,
                searchable: false
                },
            ],
            order: [[0, "asc"]],
        });
    });
</script>
@endsection