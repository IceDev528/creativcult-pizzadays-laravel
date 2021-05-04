@extends('frontLayout.app')
@section('title')
{{ __('frontend_cart.My_Account') }}
@stop
@section('style')
  <link rel="stylesheet" href="{{ URL::asset('/backend/vendors/cropper/dist/cropper.min.css') }}">
  <style>
    .cropper .img-container {
    min-height: 200px;
    max-height: 516px;
    margin-bottom: 20px;
  }
  .my_image{
    max-width: 200px
  }
  img.crop_my_image {
     max-width: 100%;
    margin-bottom: 20px;
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
   <!-- Resistiren -->
    <div class="container-fluid" id="registiren">
      <div class="row row_re">
        <div class="col-12 col-lg-2 col_text_re text-center">
           <h4 class="mb-4">{{ __('frontend_cart.My_Account') }} > </h4>
             @include('frontEnd.myaccount.sidebar.leftSidebar')
        </div>
         <div class="col-12 col-lg-8 form_re d-flex justify-content-center text-center">
              <div class="text-center">
                <img src="{{url('/').$user->path.$user->avatar}}" class="rounded_re img-fluid my_image" alt="pizza days">
                <div class="choose">
                    <input type="file" name="avatar" id="photo" class="inputfile_contact" data-url="" value="">

                    <h5>{{ __('frontend_cart.Change_Photo') }}</h5>
                    <label for="photo" class="btn btn-default choose1">{{ __('frontend_cart.Upload_file') }}</label>
                     {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
        </div>
      </div>
      {{ Form::model($user, array('method' => 'PATCH', 'url' => url('my-account/update'), 'class' => 'form-horizontal', 'files' => true)) }}
          {!! Form::hidden('image_64', null, ['class' => 'image_base64']) !!}
         <div class="row justify-content-center row_form_re">
          <div class="col">

              <div class="form-group  {{ $errors->has('first_name') ? 'has-error' : ''}} row justify-content-center">
                <div class="col-12 col-lg-4">
                      {!! Form::text('first_name', null, ['class' => 'form-control edit_re ','placeholder'=> __('frontend_cart.Vorname').'*','id'=>'Vorname-text-input-re','required'=>'required']) !!}
                      {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}

                </div>
              </div>
              <div class="form-group  {{ $errors->has('last_name') ? 'has-error' : ''}} row justify-content-center">
                <div class="col-12 col-lg-4">
                  {!! Form::text('last_name', null, ['class' => 'form-control edit_re ','placeholder'=> __('frontend_cart.Nachname'),'id'=>'Nachname-text-input-re','required'=>'required']) !!}
                      {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              <div class="form-group  {{ $errors->has('address') ? 'has-error' : ''}} row justify-content-center">
                <div class="col-12 col-lg-4">
                 {!! Form::text('address', null, ['class' => 'form-control edit_re','id'=>'Straße-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=> __('frontend_cart.Straße_Nr').'*']) !!}
                    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              <div class="form-group  {{ $errors->has('first_name') ? 'has-error' : ''}} row justify-content-center">
                <div class="col-12 col-lg-4">
                  {!! Form::text('ort', null, ['class' => 'form-control edit_re','id'=>'ORT-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=> __('frontend_cart.ORT').'*']) !!}
                    {!! $errors->first('ort', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              <div class="form-group  {{ $errors->has('first_name') ? 'has-error' : ''}} row justify-content-center">
                <div class="col-12 col-lg-4">
                  {!! Form::select('plz', $zipcodes, null, ['class' => 'form-control edit_re','id'=>'PLZ-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=> __('frontend_cart.PLZ').'*']) !!}
                    {!! $errors->first('plz', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              <div class="form-group  {{ $errors->has('first_name') ? 'has-error' : ''}} row justify-content-center">
                <div class="col-12 col-lg-4">
                  {!! Form::email('email', null, ['class' => 'form-control edit_re','id'=>'Email-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=> __('frontend_cart.Email').'*']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              <div class="form-group  {{ $errors->has('phone_number') ? 'has-error' : ''}} row justify-content-center">
                <div class="col-12 col-lg-4">
                  {!! Form::text('phone_number', null, ['class' => 'form-control edit_re','id'=>'PLZ-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=> __('frontend_cart.Vorwahl_Rufnummer')]) !!}
                    {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              <div class="form-group  {{ $errors->has('first_name') ? 'has-error' : ''}} row justify-content-center">
                <div class="col-12 col-lg-4 einkaufen_pch einkaufen_chtp">
                  <button type="submit" class="btn btn-primary btn_lo_ein">{{ __('frontend_cart.Update') }}</button>
                </div>
              </div>

          </div>
        </div>
        {{ Form::close() }}
        <div class="row justify-content-center row_form_re">
          <div class="col">
           {{ Form::model($user, array('method' => 'PATCH', 'url' => url('my-account/update/password'), 'class' => 'form-horizontal', 'files' => true)) }}
              <div class="form-group  {{ $errors->has('old_password') ? 'has-error' : ''}} row justify-content-center">
                <div class="col-12 col-lg-4">
                  {!! Form::password('old_password', ['class' => 'form-control edit_re','id'=>'Password-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=> __('frontend_cart.Alt_Password').'*' ]) !!}
                    {!! $errors->first('old_password', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              <div class="form-group  {{ $errors->has('password') ? 'has-error' : ''}} row justify-content-center">
                <div class="col-12 col-lg-4">
                  {!! Form::password('password', ['class' => 'form-control edit_re','id'=>'Password-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=> __('frontend_cart.New_Password_bestätigenv').'*' ]) !!}
                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              <div class="form-group  {{ $errors->has('password_confirmation') ? 'has-error' : ''}} row justify-content-center">
                <div class="col-12 col-lg-4">
                  {!! Form::password('password_confirmation', ['class' => 'form-control edit_re','id'=>'Password-text-input-re','required'=>'required','oninvalid'=>"this.setCustomValidity('Dieses Feld wird benötigt')" , 'oninput'=>"setCustomValidity('')",'placeholder '=> __('frontend_cart.Confirm_New_Password_bestätigenv').'*' ]) !!}
                    {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
                </div>
              </div>
              <div class="form-group row justify-content-center">
                <div class="col-12 col-lg-4 einkaufen_pch einkaufen_chtp">
                  <button type="submit" class="btn btn-primary btn_lo_ein">{{ __('frontend_cart.Update') }}</button>
                </div>
              </div>
             {{ Form::close() }}
          </div>
        </div>
    </div>
    <!-- /.Registiren -->
<!-- Modal -->
<div id="cropImage" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body cropper">
          <div class="img-container">
             <img src="" alt="" data-url="" class="crop_my_image">
          </div>
      </div>
      <div class="modal-footer">
        <button  class="btn btn-default crop-now ">{{ __('frontend_cart.Crop') }}</button>
      </div>
    </div>

  </div>
</div>


@endsection

@section('scripts')
<script src="{{ URL::asset('/backend/vendors/cropper/dist/cropper.min.js') }}"></script>
<script type="text/javascript">
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            $('.my_image').attr('src', e.target.result);
            $('.image_base64').attr('src', e.target.result);
            var img= $('.my_image').attr('src');
           $('.crop_my_image').attr('src',img);
            $('#cropImage').modal('show')
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#photo").change(function() {
        readURL(this);
      });

      function cropImage() {
        var $image = $(".crop_my_image");
            originalData = {};

       $image.cropper('destroy');

        $image.cropper({
          aspectRatio: 200/200,
          resizable: false,
          zoomable: true,
          rotatable: false,
          multiple: false,
        });
      }
      $('#cropImage').on('shown.bs.modal', function (e) {
             cropImage()
      })

     $( ".crop-now" ).click(function() {
          var image = $(".crop_my_image");
          originalData = image.cropper("getCroppedCanvas", { width: 200, height: 200 })
          var newimg=originalData.toDataURL();
           $(".image_base64").val(newimg);
           $('.my_image').attr('src', newimg);
           $('#cropImage').modal('hide')
      });


    </script>

@endsection
