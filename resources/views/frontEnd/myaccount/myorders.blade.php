@extends('frontLayout.app')
@section('title')
My Orders
@stop
@section('style')
  <!-- Datatables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">

<style>
	.dataTables_wrapper {
    width: 100% !important;
}

</style>
@endsection
@section('content')
 <!-- Image Header -->
    <div class="container-fluid" id="image_header_pch">
      <div class="row row_image_header_pch">
         <div class="col">
            <img src="{{url('/')}}/frontend/img/header_registriren.png" class="img-fluid mx-auto d-block" alt="Pizza Days">
         </div>
      </div>
    </div>
    <!-- /.Image Header -->

  <!-- Preferenzen -->
    <div class="container-fluid" id="registiren">
      <div class="row row_re">
        <div class="col-12 col-lg-2 col_text_re text-center">
           <h4 class="mb-4">My Orders > </h4>
           @include('frontEnd.myaccount.sidebar.leftSidebar')
        </div>
      </div>
      <div class="row justify-content-center row_pre">
        <div class="col-8 pt-2 pl-4 col_12_pre">
          <h2>All Orders</h2>
        </div>
      </div>
      <div class="row justify-content-center row_2_pre">
        <div class="col-8">
          <div class="row row_pre_product">
           
		               <table class="table responsive nowrap" id="tbl_myorder" width="100%">
					            <thead>
					                <tr>
					                    <th>Order Id</th>
					                    <th>Delivery Date</th>
                              <th>Status</th>
					                    <th>Method</th>
					                    <th>Total</th>
					                    <th>Created At</th>
					                    <th>Ordered</th>
					                    <th>Actions</th>
					                </tr>
					            </thead>
					            <tbody>

						            @foreach ($myorder as $order)
						            	
						                <tr>
						                    <td>{{ $order->user_id.'-'.$order->id.'-'.$order->cart_id }}</td>
						                    <td>{{ $order->date_delivery }}</td>
                                <td>{{ $order->status }}</td>
						                    <td>{{ $order->method }}</td>
						                    <td>{{ $order->total }}</td>
						                    <td>{{ $order->created_at }}</td>
						                   <td> 
                                <div class="row">
						                   @foreach($order->cart->product as $key => $product)
                                 <div class="col grid_my_order">
                                  <img class="img-fluid mx-auto d-block" src="{{url('/').$product->path.'thumb_'.$product->image}}" alt="{{$product->name}}" width="80px">
						                    	<h2>{{ $product->name}}</h2>
                                  <h3> <span class="product_price{{$product->pivot->attribute.$product->pivot->quantity}}"> {{$product->ProductAttributePrice($product->pivot->attribute,$product->pivot->quantity)}} </span>  {{$appsettings->currency}}</h3>
                                 <p>{{$product->ProductAttributeName($product->pivot->attribute)}}</p>
                                 </div>
						                    @endforeach
                                 </div>
						                    </td>
						                    <td>
						                        <a href="{{url('/').'/upload/invoice/INV-'.Sentinel::getUser()->id.'-'.$order->cart->id.'.pdf' }}" target="_blank" class="btn btn-primary btn-xs">Invoice</a> 
						                    </td>
						                </tr>
						               
						            
					             @endforeach
					            </tbody>
					   </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.Preferenzen -->

@endsection

@section('scripts')
<!-- datatables -->
    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript">
   
var table = $('#tbl_myorder').DataTable({
             responsive: true,
             order: [[ 5, 'desc' ]]
          

           });
 


</script>

@endsection