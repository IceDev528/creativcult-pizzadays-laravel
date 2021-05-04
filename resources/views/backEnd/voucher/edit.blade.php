@extends('backLayout.app')
@section('title')
Edit Voucher
@stop
@section('style')
<link rel="stylesheet" href="{{ URL::asset('/frontend/css/jquery.datetimepicker.min.css') }}">
@endsection
@section('content')

    <h1>Edit Voucher</h1>
    <hr/>

    {!! Form::model($voucher, [
        'method' => 'PATCH',
        'url' => ['voucher', $voucher->id],
        'class' => 'form-horizontal'
    ]) !!}

            <div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
                {!! Form::label('code', 'Code: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('code', null, ['class' => 'form-control','required'=>'required', 'placeholder'=>'Enter your coupon code']) !!}
                    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control','required'=>'required','placeholder'=>'Enter coupon name']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                {!! Form::label('description', 'Description: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('description', null, ['class' => 'form-control','placeholder'=>'Enter coupon description']) !!}
                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('voucher_type') ? 'has-error' : ''}}">
                {!! Form::label('voucher_type', 'Coupon type: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('voucher_type',['all_users'=>'All Users','location'=>'Location','zip_code'=>'Zip Code','single_user'=>'Only selected User'], null, ['class' => 'form-control','required'=>'required','placeholder'=>'Coupon Type']) !!}
                    {!! $errors->first('voucher_type', '<p class="help-block">:message</p>') !!}
                    <p>Where this cupon code will be aplied</p>
                </div>
            </div>
            <div class="form-group {{ $errors->has('location_id') ? 'has-error' : ''}} location_form_group" style="display: none;">
                {!! Form::label('location_id', 'Location Code: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                     {!! Form::select('location_id',$locations, null, ['class' => 'form-control','placeholder'=>'Location Name']) !!}
                    {!! $errors->first('location_id', '<p class="help-block">:message</p>') !!}
                    <p>This options will work only if you select the  code type Location </p>
                </div>
            </div>
            <div class="form-group {{ $errors->has('zip_code_id') ? 'has-error' : ''}} zip_code_form_group" style="display: none;">
                {!! Form::label('zip_code_id', 'Zip Code: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                     {!! Form::select('zip_code_id', $zipcodes, null, ['class' => 'form-control','placeholder'=>'Zip Codes']) !!}
                    {!! $errors->first('zip_code_id', '<p class="help-block">:message</p>') !!}
                    <p>This is only when you want thi code to be apliedn on into a zip code</p>
                </div>
            </div>
            <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}} user_id_form_group" style="display: none;">
                {!! Form::label('user_id', 'Single User: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                   
                     {!! Form::select('user_id',$users, null, ['class' => 'form-control','placeholder'=>'Select a single user']) !!}
                    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
                    <p>This is only when you want thi code to be aplied to a single users</p>
                </div>
            </div>
            <div class="form-group {{ $errors->has('max_uses') ? 'has-error' : ''}}">
                {!! Form::label('max_uses', 'Max Uses: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('max_uses', null, ['class' => 'form-control','required'=>'required', 'placeholder'=>'How much time can be used this coupon code']) !!}
                    {!! $errors->first('max_uses', '<p class="help-block">:message</p>') !!}
                    <p>Add the max time this cupon code can be used</p>
                </div>
            </div>
            <div class="form-group {{ $errors->has('max_uses_user') ? 'has-error' : ''}}">
                {!! Form::label('max_uses_user', 'Single user can use this:', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('max_uses_user', null, ['class' => 'form-control','required'=>'required', 'placeholder'=>'How much time can be used by a single user']) !!}
                    {!! $errors->first('max_uses_user', '<p class="help-block">:message</p>') !!}
                    <p>Add the max time this cupon code can be used by a single user</p>
                </div>
            </div>
            <div class="form-group {{ $errors->has('discount_amount') ? 'has-error' : ''}}">
                {!! Form::label('discount_amount', 'Discount Amount: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('discount_amount', null, ['class' => 'form-control','required'=>'required', 'placeholder'=>'The total Discount value']) !!}
                    {!! $errors->first('discount_amount', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('is_fixed') ? 'has-error' : ''}}">
                {!! Form::label('is_fixed', 'Is Fixed: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                                <div class="checkbox">
                <label>{!! Form::radio('is_fixed', '1') !!} Yes</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('is_fixed', '0', true) !!} No</label>
            </div>
                    {!! $errors->first('is_fixed', '<p class="help-block">:message</p>') !!}
                     <p>If you select  no the discount will be in % of total value </p>
                </div>
            </div>
            <div class="form-group {{ $errors->has('starts_at') ? 'has-error' : ''}}">
                {!! Form::label('starts_at', 'Starts At: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                      {!! Form::text('starts_at', null, ['class' => 'form-control','required'=>'required', 'placeholder'=>'Enter start date time']) !!}
                    {!! $errors->first('starts_at', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('expires_at') ? 'has-error' : ''}}">
                {!! Form::label('expires_at', 'Expires At: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                
                    {!! Form::text('expires_at', null, ['class' => 'form-control','required'=>'required', 'placeholder'=>'Enter expires date time']) !!}
                    {!! $errors->first('expires_at', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
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
<script src="{{ URL::asset('/frontend/js/jquery.datetimepicker.full.min.js') }}"></script>

<script>
var myvouchertype='{{$voucher->voucher_type}}';
showHideFormGroup(myvouchertype);

$('#voucher_type').on('change', function() {
    showHideFormGroup(this.value);
})

function showHideFormGroup(value) {
    if (value ==='location') {
        $('.location_form_group').show();
        //HIDE OTHER OPTIONS
        $('.zip_code_form_group').hide();
         $('.user_id_form_group').hide();
    }else if (value ==='zip_code'){
        $('.zip_code_form_group').show();
        //hide other options
         $('.user_id_form_group').hide();
          $('.location_form_group').hide();
    }else if (value ==='single_user'){
        $('.user_id_form_group').show();
        //hide  other options
         $('.zip_code_form_group').hide();
          $('.location_form_group').hide();
    }
}
jQuery(function(){
 jQuery('#starts_at').datetimepicker({
  formatDate:'DD.MM.YYYY',
     format:'d/m/Y H:i',
 });
 jQuery('#expires_at').datetimepicker({
  formatDate:'DD.MM.YYYY',
     format:'d/m/Y H:i',
  onShow:function( ct ){
   this.setOptions({
    minDate:jQuery('#starts_at').val()?jQuery('#starts_at').val():false
   })
  },
  
 });
});

</script>
@endsection