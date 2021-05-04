@extends('backLayout.app')
@section('title')
{{ __('bck_product.Create_new_Product') }}
@stop

@section('content')

    <h1>{{ __('bck_product.Create_new_Product') }}</h1>
    <hr/>

    {!! Form::open(['url' => 'product', 'class' => 'form-horizontal', 'files' => true]) !!}

          <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name',  __('bck_attribute.Name') .':' , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control','required'=>'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}} parent_category">
                {!! Form::label('category_id', __('bck_category.Category') , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control','placeholder'=> __('bck_category.Select_category_parent'),'required'=>'required']) !!}
                    {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                {!! Form::label('image',  __('bck_product.Image').' :' , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::file('image',['class' => 'form-control image_upload','required']) !!}
                     <img src="" class="img-responsive my_file_upload" style="display: none;" alt="pizza days">
                    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                {!! Form::label('description',  __('bck_category.Description').' :' , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('attribute') ? 'has-error' : ''}}">
                {!! Form::label('attribute',  __('bck_product.Attribute') .':' , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <div class="panel panel-default">
                      <div class="panel-heading">{{ __('bck_product.Add_Remove_Multiple_Attributes') }}</div>
                      <div class="panel-body">

                        <div class="col-sm-6 nopadding">
                          <div class="form-group">
                             {!! Form::select('attributes[]', $attribute, null, ['class' => 'form-control col-sm-12','placeholder'=> __('bck_product.Select_Attribute') ,'required'=>'required']) !!}
                          </div>
                        </div>
                        <div class="col-sm-6 nopadding">
                          <div class="form-group">
                          <div class="input-group">
                            <input type="number" class="form-control" step="any" id="price" name="price[]" value="{{ old('price[]') }}" placeholder="Add Price" required>
                            <div class="input-group-btn">
                                <button class="btn btn-success" type="button"  onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="clear"></div>
                        <div id="education_fields">

                       </div>

                      </div>
                      <div class="panel-footer"><small>{{ __('bck_order.Press') }} <span class="glyphicon glyphicon-plus gs"></span> {{ __('bck_product.to_add_another_form_field') }}</small>, <small>Press <span class="glyphicon glyphicon-minus gs"></span> {{ __('bck_attribute.to_remove_form_field') }} :)</small></div>
                    </div>
                    {!! $errors->first('attribute', '<p class="help-block">:message</p>') !!}
                </div>
            </div>





    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit(__('bck_auth.Create'), ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection

@section('scripts')
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            $('.my_file_upload').attr('src', e.target.result);
            $('.my_file_upload').show();
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      $(".image_upload").change(function() {
        readURL(this);
      });

    var room = 1;
function education_fields() {

    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass"+room);
    var rdiv = 'removeclass'+room;
        divtest.innerHTML = '<div class="col-sm-6 nopadding">\
                          <div class="form-group">\
                              {!! Form::select('attributes[]', $attribute, null, ['class' => 'form-control col-sm-12','placeholder'=>__('bck_product.Select_Attribute')]) !!}\
                          </div>\
                        </div>\
                        <div class="col-sm-6 nopadding">\
                          <div class="form-group">\
                          <div class="input-group">\
                             <input type="number" class="form-control" step="any" id="price" name="price[]" value="" placeholder="Add Price" required>\
                            <div class="input-group-btn">\
                                <button class="btn btn-danger" type="button"  onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button>\
                              </div>\
                            </div>\
                          </div>\
                        </div>\
                        <div class="clear"></div>';


    objTo.appendChild(divtest)
}
   function remove_education_fields(rid) {
       $('.removeclass'+rid).remove();
   }
</script>
@endsection
