@extends('frontLayout.app')

@section('title')
{{ __('frontend_cart.My_Cart') }}
@stop
@section('style')
<link rel="stylesheet" href="{{ URL::asset('/frontend/css/jquery.datetimepicker.min.css') }}">
@endsection
@section('content')
     <!-- My Order -->
    <div class="container-fluid" id="choose_to_pay">
    @if($cart)
      <div class="row main_row_chtp">
           <div class="col-lg-8 col_8_chtp">
              <h2>{{ __('frontend_cart.My_Order') }}</h2>
              <hr class="mb-4">
              @foreach($cart->product as $product)

              <div class="row row_order_chtp">
                <div class="col-12 col-lg-3">
                  <img class="img-fluid mx-auto d-block" src="{{url('/').$product->path.'thumb_'.$product->image}}" alt="{{$product->name}}">
                </div>
                <div class="col-6 col-lg-6 text-left">
                    <h2>{{$product->name}}</h2>
                    <p>{{$product->description}} </p>
                    <div class="row row_delete_chtp">
                      <div class="col-2">
                         {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['cart', $cart->id],
                            'style' => 'display:inline'
                        ]) !!}
                             {!! Form::hidden('product', $product->id, ['class' => 'form-control','required'=>'required']) !!}
                             {!! Form::hidden('attribute', $product->pivot->attribute, ['class' => 'form-control','required'=>'required']) !!}
                             {!! Form::hidden('quantity', $product->pivot->quantity, ['class' => 'form-control','required'=>'required']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn_delete_chtp']) !!}
                        {!! Form::close() !!}
                      </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 text-left">
                    <h2> <span class="product_price{{$product->pivot->attribute.$product->pivot->quantity}}"> {{$product->ProductAttributePrice($product->pivot->attribute,$product->pivot->quantity)}} </span>  {{$appsettings->currency}}</h2>
                    <p>{{$product->ProductAttributeName($product->pivot->attribute)}}</p>
                    {!! Form::open([
                            'method'=>'post',
                            'url' => ['cart-update', $cart->id],
                            'style' => 'display:inline'
                        ]) !!}
                    <div class="row">
                      <label for="number-input-chtp" class="col-2 col-form-label">Qty:</label>
                      <div class="col-5">

                        <input class="form-control" type="number" name="quantity" value="{{$product->pivot->quantity}}" id="number-input-chtp" min="1" max="999">
                         {!! Form::hidden('product', $product->id, ['class' => 'form-control','required'=>'required']) !!}
                         {!! Form::hidden('attribute', $product->pivot->attribute, ['class' => 'form-control','required'=>'required']) !!}

                      </div>
                      <button type="submit" class="refresh_btn">
                              <i class="fa fa-refresh " aria-hidden="true"></i>
                      </button>

                    </div>
                    {!! Form::close() !!}
                </div>
              </div>
              @endforeach
              <div class="row mt-4 pl-1 row_datum_chtp">
                <div class="row">
                  <div class="col docs-datepicker">
                      {{ __('frontend_cart.Current_time') }}: <span id="now_time_date"></span>
                    <div class="input-group date_input">
                      <label class="col-4 mr-3 datum_chtp"><h2>{{ __('frontend_cart.Datum') }}:</h2></label>

                      <input type="text" class="col-8 form-control docs-date datum_time_chtp" id="datetimepicker" name="date" placeholder="Pick a date" value="{{\Carbon\Carbon::now('Europe/Berlin')->addMinutes(20)->format('d/m/Y H:i') }}">
                    </div>
                    <p class="help-block error_ontime"> </p>
                  </div>
                </div>
              </div>
              <hr class="mb-4 mt-4">
              <div class="row justify-content-between total_chtp">
                <div class="col-4">
                  <h2>{{ __('frontend_cart.Subtotal') }}</h2>
                  <h2>{{ __('frontend_cart.Mehrwertsteuer') }} {{$appsettings->tax}}%</h2>
                  <h2>{{ __('frontend_cart.Shipping') }}</h2>
                  <h2>{{ __('frontend_cart.Coupon_discount') }}</h2>
                </div>
                <div class="col-4 text-center">
                  <h2>{{$cart->CartTotal()}}{{$appsettings->currency}}</h2>
                  <h2>{{ number_format(($appsettings->tax / 100) * $cart->CartTotal(), 2) }} {{$appsettings->currency}}</h2>
                  <h2>0,00{{$appsettings->currency}}</h2>
                  <h2>- {{ $cart->getVouchere() }} {{$appsettings->currency}}</h2>
                </div>
              </div>
              <hr class="mb-4 mt-4">
              <div class="row justify-content-between total_chtp">
                <div class="col-4">
                  <h2>{{ __('frontend_cart.Total') }}</h2>
                </div>
                <div class="col-4 text-center">
                    <?php $totaltax=($cart->CartTotal() + (($appsettings->tax / 100) * $cart->CartTotal())-$cart->getVouchere()); ?>
                  <h2>{{number_format($totaltax, 2) }}{{$appsettings->currency}}</h2>
                </div>
              </div>
                {{ Form::open(array('url' => url('voucher-apply'), 'class' => 'form-horizontal','files' => true)) }}
                <div class="row row_payment_chtp">
                    <div class="col-7 col-lg-3">
                        <div class="form-group">
                          <label for="formGroupInput"><h2>{{ __('frontend_cart.Coupon_Code') }}</h2></label>
                          <input type="text" class="form-control {{(\Session::get('coupon_staus') || $cart->voucher()->first() )?'green-border':''}}" name="coupon" value="{{\Session::get('coupon')}}" id="formGroupInput" placeholder="{{ ($cart->voucher()->first())?$cart->voucher()->first()->code:''}}" > 
                          @if($cart->voucher()->first())
                            <p>
                            You have added the Coupon Code {{$cart->voucher()->first()->code}}<br>
                            @if($cart->voucher()->first()->is_fixed)
                            <strong> Value: </strong> {{number_format($cart->voucher()->first()->discount_amount,2)}} </p>
                            @else
                            <strong> Value: </strong> {{$cart->voucher()->first()->discount_amount }} % of your cart</p>
                            @endif
                            <a href="{{ url('voucher-apply', ['cart_id'=>$cart->id,'code_id'=>$cart->voucher()->first()->id]) }}">Remove</a>
                          @endif
                        </div>
                    </div>
                    <div class="col-12 einkaufen_pch einkaufen_chtp">
                     <button type="submit" class="btn btn-primary float-left">{{ __('frontend_cart.Apply') }}</button>
                    </div>
                </div>
               {{ Form::close() }}
           </div>
           <div class="col-lg-4 col_4_chtp">
              <div class="row mb-4">
                  <div class="col-7">
                    <h2>{{ __('frontend_cart.Adress_Delivery') }}* </h2>
                  </div>
              </div>
               <div class="col-7 explain_chtp">
                   <p><strong>{{ __('frontend_cart.Straße_Nr') }}* :</strong> {{Sentinel::getuser()->address}}</p>
                   <p><strong>{{ __('frontend_cart.ORT') }}* :</strong> {{Sentinel::getuser()->ort}}</p>
                   <p><strong>{{ __('frontend_cart.PLZ') }}* :</strong> {{(Sentinel::getuser()->zipcode)?Sentinel::getuser()->zipcode->name:''}}</p>
                   <p><strong>{{ __('frontend_cart.Vorwahl_Rufnummer') }}* :</strong> {{Sentinel::getuser()->phone_number}}</p>

                </div>
              {{ Form::model(Sentinel::getuser(), array('method' => 'PATCH', 'url' => url('my-account/update'), 'class' => 'form-horizontal', 'files' => true)) }}
                <div class="row row_two_btns_chtp">
                  <div class="col-7">
                    <button class="btn btn_delete_chtp btn_apply_chtp float-left" id="edit_btn_chtp" type="button" data-toggle="collapse" href="#collapse11" aria-expanded="false" aria-controls="collapse11">{{ __('frontend_cart.Edit') }}</button>
                    <button class="btn btn_delete_chtp btn_apply_chtp float-right" type="submit">{{ __('frontend_cart.Aktualisiren') }}</button>
                  </div>
                </div>
                <div class="row">
                    <div class="col-12 collapse" id="collapse11">
                        <div class="form-group row {{ $errors->has('address') ? 'has-error' : ''}}">
                          <div class="col-7">
                              {!! Form::hidden('first_name', null, ['class' => 'first_name']) !!}
                              {!! Form::hidden('last_name', null, ['class' => 'last_name']) !!}
                              {!! Form::hidden('email', null, ['class' => 'email']) !!}
                            {!! Form::text('address', null, ['class' => 'form-control edit_re','id'=>'strasse-text-input','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=>'Straße + Nr*']) !!}
                            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                          </div>
                        </div>
                        <div class="form-group row {{ $errors->has('ort') ? 'has-error' : ''}}">
                          <div class="col-7">
                            {!! Form::text('ort', null, ['class' => 'form-control edit_re','id'=>'strasse-text-input','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=>'ORT*']) !!}
                             {!! $errors->first('ort', '<p class="help-block">:message</p>') !!}
                          </div>
                        </div>
                        <div class="form-group {{ $errors->has('plz') ? 'has-error' : ''}}">
                          <div class="col-7 Select_chtp">
                            {!! Form::select('plz', $zipcodes, null, ['class' => 'form-control edit_re','id'=>'Select1_chtp','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=>'PLZ*']) !!}
                           {!! $errors->first('plz', '<p class="help-block">:message</p>') !!}
                          </div>
                        </div>
                        <div class="form-group row {{ $errors->has('phone_number') ? 'has-error' : ''}}">
                          <div class="col-7">
                            {!! Form::text('phone_number', null, ['class' => 'form-control edit_re','id'=>'telefon-tel-input','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=>'Vorwahl / Rufnummer']) !!}
                            {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                          </div>
                        </div>

                    </div>
                </div>
               {{ Form::close() }}
              {{ Form::open(array('url' => url('paypal'), 'class' => 'form-horizontal form-signin','files' => true)) }}
                {!! Form::hidden('cart_id', $cart->id, ['class' => 'cart_id']) !!}
                {!! Form::hidden('date',\Carbon\Carbon::now('Europe/Berlin')->addMinutes(20)->format('d/m/Y H:i'), ['class' => 'date_final']) !!}
                <div class="row row_payment_chtp">
                    <div class="col-7">
                      <div class="form-check">
                        <label class="form-check-label">

                          <input class="form-check-input" type="radio" name="paymentMethod" id="Radios3" value="at_pizzadays" required="required">
                          <h3>{{ __('frontend_cart.I_will_take_the_food_at_Pizzadays') }} {{(Sentinel::getUser()->zipCode)?Sentinel::getUser()->zipCode->location->name:''}}</h3>

                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="radio" name="paymentMethod" id="Radios1" value="paypal" required="required" checked>
                          <h3>Paypal</h3>
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">

                          <input class="form-check-input" type="radio" name="paymentMethod" id="Radios2" value="in_hand" required="required">
                          <h3>{{ __('frontend_cart.In_Hand') }}</h3>

                        </label>
                      </div>
                    </div>
                    <div class="col-7 einkaufen_pch einkaufen_chtp">
                     <button class="btn btn-primary float-right" type="submit">{{ __('frontend_cart.Einkaufen') }}</button>
                    </div>
                </div>
              {{ Form::close() }}
           </div>
      </div>
      @else
      <div class="row main_row_chtp justify-content-md-center">
          <div class="col-12 col-md-auto">
                       <h1>{{ __('frontend_cart.No_products_added') }}</h1>
                         <a href="{{url('shop')}}" class="my_button ">{{ __('frontend_cart.Go_to_Shop') }}</a>
        </div>
      </div>

      @endif
    </div>
    <!-- /.My Order -->
@endsection

@section('scripts')
<script src="{{ URL::asset('/frontend/js/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ URL::asset('/frontend/js/moment.js') }}"></script>

<script>
  $( "input[name='quantity']" ).change(function(e) {
      $(this).closest(".row").find('.refresh_btn').show();
 });

var logic = function( currentDateTime ){
    //check if is Today
     var current_time=$('#datetimepicker').val();
        $.ajax({
              type: "POST",
              cache: false,
              url : "{{action('CartController@AllowedMinMaxDate')}}",
              data: {SelectedDate:current_time},
                  success: function(data) {
                        $('#datetimepicker').datetimepicker({
                           minTime:data.min,
                           maxTime:data.max
                        });
                      if (data.status=='success') {

                      }else{
                          toastr.error(data.message);
                      }
                  },
                  error: function() {
                      alert('Error occured');
                  }
           })
      this.setOptions( {disabledDates: ['{!!$appsettings->disabled_dates!!}'], formatDate:'m/d/Y',disabledWeekDays:[{!!$appsettings->closed_weekdays!!}]})
};

</script>
<script src="{{ URL::asset('/frontend/js/datepickerLogic.js') }}"></script>
@endsection
