@extends('frontLayout.app')
@section('title')
{{ __('frontend_cart.My_Favourite') }}
@stop
@section('style')

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
           <h4 class="mb-4">{{ __('frontend_cart.My_Favourite') }} > </h4>
           @include('frontEnd.myaccount.sidebar.leftSidebar')
        </div>
      </div>
      <div class="row justify-content-center row_pre">
        <div class="col-8 pt-2 pl-4 col_12_pre">
          <h2>{{ __('frontend_cart.Präferenzen') }}</h2>
        </div>
      </div>
      <div class="row justify-content-center row_2_pre">
        <div class="col-8">
          <div class="row row_pre_product">
            @forelse ($user->favourite as $product)
                <div class="col">
                  <div class="col filtr-item" data-category="1">
                    <div class="row contain_menu_navs_filter_pch">
                       <div class="col img_pizzamenu">
                          <i class="fa fa-heart {{(Sentinel::getUser()->favourite()->where('id', $product->id)->exists())?'heart_red':'' }} addRemoveFavourite" data-favourite="active" aria-hidden="true" data-product="{{$product->id}}"></i>
                          <img class="img-fluid mx-auto d-block" src="{{url('/').$product->path.'thumb_'.$product->image}}" alt="{{$product->name}}">
                       </div>
                       <div class="col content_pizzamenu">
                          <h5 class="item-desc text-center">{{$product->name}}</h5>
                          <p>{{$product->description}} </p>
                              <div class="row  einkaufen_pre">
                              <form class="addToCart">
                                <div class="col">
                                    @foreach ($product->attribute as $atribute)
                                        @if ($loop->first)
                                          <div class="form-check form-check-inline">
                                            <label class="form-check-label check_content_pizzamenu {{($product->CheckIfProductIsOnCurrentCart($atribute->id))?'atribute_selected':''}}">
                                              <input class="form-check-input" type="radio" name="menu_atribute" value="{{ $atribute->id }}" data-price="{{ $atribute->pivot->price  }}" data-product="{{$product->id}}" checked="checked"> {{ $atribute->name }}
                                            </label>
                                          </div>
                                          @else
                                          <div class="form-check form-check-inline">
                                            <label class="form-check-label check_content_pizzamenu {{($product->CheckIfProductIsOnCurrentCart($atribute->id))?'atribute_selected':''}}">
                                              <input class="form-check-input" type="radio" name="menu_atribute" value="{{ $atribute->id }}" data-price="{{ $atribute->pivot->price  }}" data-product="{{$product->id}}"> {{ $atribute->name }}
                                            </label>
                                          </div>

                                        @endif
                                    
                                     @endforeach
                                   <button type="submit" class="btn btn-primary mx-auto d-block">{{ __('frontend_cart.einkaufen') }}</button>

                                </div>
                              </form>
                              </div>
                       </div>
                    </div>
                  </div>
                </div>
                @empty

                      <h1>{{ __('frontend_cart.No_products_added') }}</h1>
                         <a href="{{url('shop')}}" class="my_button ">{{ __('frontend_cart.Go_to_Shop') }}</a>
                @endforelse
          </div>
        </div>
      </div>
    </div>
    <!-- /.Preferenzen -->

@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="{{url('/')}}/frontend/js/jquery.filterizr.js"></script>
<script src="{{url('/')}}/frontend/js/controls.js"></script>
<script src="{{url('/')}}/frontend/js/addtocart.js"></script>
<script>
   //Start Activate all Function
          $(".addRemoveFavourite").click(function(event){
                 event.preventDefault();
                  var myhart=$(this);
                  var product_id=$(this).data('product');
                  if (product_id) {
                       $.ajax({
                          type: "POST",
                          cache: false,
                          url : "{{action('MyAccountController@AttachDettachMyfavouriteProducts')}}",
                          data: {productId:product_id},
                              success: function(data) {

                                if (data.type === 'attach') {
                                  myhart.addClass("heart_red");
                                 }else{
                                  myhart.removeClass("heart_red");
                                 }
                                 toastr.success(data.status);
                                 location.reload();
                              }
                          })

                      }else{return confirm("You have to select any checkbox before");}

          });
          //End Activate Function
          //Start addToCart
             $( '.addToCart' ).on( 'submit', function(event) {
                  event.preventDefault();
                  jQuery.noConflict(); 
                  var logedin='{{Sentinel::guest()}}';
                  if( logedin!='' ){
                    $('#myModal').modal('show');
                    return false;
                  }
                  var product=$(this).find("input[name='menu_atribute']:checked");
                  var attribute=product.val()
                  var price=product.data('price')
                  var productID=product.data('product')
                  var itemImg = product.closest(".contain_menu_navs_filter_pch").find('img').eq(0);
                  if (attribute && product ) {
                       $.ajax({
                          type: "POST",
                          cache: false,
                          url : "{{action('CartController@addItem')}}",
                          data: {attribute_id:attribute,price:price,product_id:productID},
                              success: function(data) {
                               
                                if (data.success) {
                                  product.closest('label').addClass("atribute_selected");
                                  toastr.success(data.message);
                                  $('.badge_price_total').html(data.cartTotal);
                                  addToCartEfect(itemImg)
                                 }else{
                                 product.closest('label').addClass("atribute_warning");
                                 toastr.error(data.message);
                                 setTimeout( function(){ 
                                   product.closest('label').removeClass("atribute_warning");
                                    product.closest('label').addClass("atribute_selected");
                                    }  , 2000 );
                                 }
                                
                              }
                          })

                      }else{return confirm("You have to select any checkbox before");}
              
            });
          //End Activate Function
</script>

@endsection
