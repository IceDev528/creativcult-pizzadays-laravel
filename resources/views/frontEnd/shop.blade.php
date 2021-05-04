@extends('frontLayout.app')
@section('title')
{{ __('frontend_cart.Your_Shop') }}
@stop
@section('content')
 <!-- Image Header -->
    <div class="container-fluid" id="image_header_pch">
      <div class="row row_image_header_pch">
         <div class="col">
            <img src="{{url('/')}}/frontend/img/backg.png" class="img-fluid mx-auto d-block" alt="Pizza Days">
         </div>
      </div>
    </div>
    <!-- /.Image Header -->

    <!-- Navs Filter -->
    <div class="container-fluid mt-4" id="navs_filter_pch">

            <!-- Filter Controls - Simple Mode -->
            <div class="row justify-content-center">
                <!-- A basic setup of simple mode filter controls, all you have to do is use data-filter="all"
                for an unfiltered gallery and then the values of your categories to filter between them -->
                <ul class="simplefilter">
                    <li class="{{($selectCat)?'':'active'}}"  data-filter="all">{{ __('frontend_cart.All') }}</li>
                    @foreach($categories as $category)
                        @if($selectCat && $selectCat->id == $category->id)
                         <li class="active" data-filter="{{$category->id}}">{{$category->name}}</li>
                        @else
                        <li data-filter="{{$category->id}}">{{$category->name}}</li>
                      @endif
                    @endforeach

                </ul>
            </div>
            <!-- Search control -->
            <div class="row search-row justify-content-center">
                <p>Search:</p>
                <input type="text" class="filtr-search" name="filtr-search" data-search>
            </div>

            <div class="container-fluid">
                <!-- This is the set up of a basic gallery, your items must have the categories they belong to in a data-category
                attribute, which starts from the value 1 and goes up from there -->
                <div class="filtr-container">
                    @forelse ($products as $product)
                    <div class="col-6 filtr-item" data-category="{{$product->category_id}}">
                        <div class="row contain_menu_navs_filter_pch">
                           <div class="col-12 col-md-6 img_pizzamenu">
                              <i id="heart" class="fa fa-heart addRemoveFavourite {{(!Sentinel::guest() && Sentinel::getUser()->favourite()->where('id', $product->id)->exists())?'heart_red':'' }}" data-favourite="active" data-product="{{$product->id}}" aria-hidden="true"></i>
                              <img class="img-fluid mx-auto d-block" src="{{url('/').$product->path.'thumb_'.$product->image}}" alt="{{$product->name}}">
                           </div>
                           <div class="col content_pizzamenu">
                              <h2 class="item-desc">{{$product->name}}</h2>
                              <p>{{$product->description}} </p>
                              <form class="addToCart">
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
                                  <div class="row einkaufen_pch">
                                    <div class="col">
                                       <button type="submit" class="btn btn-primary mx-auto d-block">{{ __('frontend_cart.einkaufen') }}</button>
                                    </div>
                                  </div>
                               </form>
                           </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    @empty
                      <li>{{ __('frontend_cart.No_products_added') }}</li>
                  @endforelse
                </div>
            </div>

    </div>
    <!-- /.Navs Filter -->
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="{{url('/')}}/frontend/js/jquery.filterizr.js"></script>
<script src="{{url('/')}}/frontend/js/controls.js"></script>
<script src="{{url('/')}}/frontend/js/addtocart.js"></script>
    <!-- Kick off Filterizr -->
    <script type="text/javascript">
        $(function() {
            //Initialize filterizr with default options
            @if($selectCat)
            $('.filtr-container').filterizr({ filter: '{{$selectCat->id}}'});
            @else
            $('.filtr-container').filterizr({ filter: 'all'});
            @endif

          //Start addRemoveFavourite
          $(".addRemoveFavourite").click(function(event){
                 event.preventDefault();
                  jQuery.noConflict();
                  var logedin='{{Sentinel::guest()}}';
                  if( logedin!='' ){
                    $('#myModal').modal('show');
                    return false;
                  }
                  var myhart=$(this);
                  var product_id=myhart.data('product');
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
                              }
                          })

                      }else{return confirm("You have to select any checkbox before");}

          });
          //End addRemoveFavourite
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
                  var itemImg = product.closest(".row").find('img').eq(0);
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

        });
    </script>
@endsection
