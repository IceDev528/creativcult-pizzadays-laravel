@extends('backLayout.app')
@section('title')
{{ __('bck_appsetting.App_Einstellungen') }}
@stop
@section('style')
<link rel="stylesheet" href="{{ URL::asset('/backend/vendors/jquery-ui-1.12.1/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/backend/vendors/multipledatepicker/jquery-ui.multidatespicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/frontend/css/jquery.datetimepicker.min.css') }}">
@endsection
@section('content')

    <h1>{{ __('bck_appsetting.App_Einstellungen') }}</h1>
    <hr/>

    {!! Form::model($appsetting, [
        'method' => 'PATCH',
        'url' => ['appsetting', $appsetting->id],
        'class' => 'form-horizontal'
    ]) !!}

            <div class="form-group {{ $errors->has('tax') ? 'has-error' : ''}}">
                {!! Form::label('tax',  __('bck_appsetting.Mehrwertsteuer') , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('tax', null, ['class' => 'form-control']) !!}

                    {!! $errors->first('tax', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('currency') ? 'has-error' : ''}}">
                {!! Form::label('currency',  __('bck_appsetting.Currency') , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('currency', array('&euro;' => 'Euro', '$' => 'Dollar'),null,['class' => 'form-control']); !!}
                    {!! $errors->first('currency', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('mon_start') ? 'has-error' : ''}}">
                {!! Form::label('mon_start',  __('bck_appsetting.Monday') , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-3">
                    {!! Form::text('mon_start', null, ['class' => 'form-control time_pciker_max']) !!}
                    {!! $errors->first('mon_start', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::text('mon_end', null, ['class' => 'form-control time_pciker_max']) !!}
                    {!! $errors->first('mon_end', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('tue_start') ? 'has-error' : ''}}">
                {!! Form::label('tue_start',  __('bck_appsetting.Tuesday') , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-3">
                    {!! Form::text('tue_start', null, ['class' => 'form-control time_pciker_max']) !!}
                    {!! $errors->first('tue_start', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::text('tue_end', null, ['class' => 'form-control time_pciker_max']) !!}
                    {!! $errors->first('tue_end', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('wed_start') ? 'has-error' : ''}}">
                {!! Form::label('wed_start',  __('bck_appsetting.Wendsday') , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-3">
                    {!! Form::text('wed_start', null, ['class' => 'form-control time_pciker_max']) !!}
                    {!! $errors->first('wed_start', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::text('wed_end', null, ['class' => 'form-control time_pciker_max']) !!}
                    {!! $errors->first('wed_end', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('thu_start') ? 'has-error' : ''}}">
                {!! Form::label('thu_start',  __('bck_appsetting.Thursday') , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-3">
                    {!! Form::text('thu_start', null, ['class' => 'form-control time_pciker_max']) !!}
                    {!! $errors->first('thu_start', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::text('thu_end', null, ['class' => 'form-control time_pciker_max']) !!}
                    {!! $errors->first('thu_end', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('fri_start') ? 'has-error' : ''}}">
                {!! Form::label('fri_start',  __('bck_appsetting.Friday') , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-3">
                    {!! Form::text('fri_start', null, ['class' => 'form-control time_pciker_max']) !!}
                    {!! $errors->first('fri_start', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::text('fri_end', null, ['class' => 'form-control time_pciker_max']) !!}
                    {!! $errors->first('fri_end', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('sat_start') ? 'has-error' : ''}}">
                {!! Form::label('sat_start',  __('bck_appsetting.Saturday') , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-3">
                    {!! Form::text('sat_start', null, ['class' => 'form-control time_pciker_max']) !!}
                    {!! $errors->first('sat_start', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::text('sat_end', null, ['class' => 'form-control time_pciker_max']) !!}
                    {!! $errors->first('sat_end', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('sun_start') ? 'has-error' : ''}}">
                {!! Form::label('sun_start',  __('bck_appsetting.Sunday') , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-3">
                    {!! Form::text('sun_start', null, ['class' => 'form-control time_pciker_max']) !!}
                    {!! $errors->first('sun_start', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::text('sun_end', null, ['class' => 'form-control time_pciker_max']) !!}
                    {!! $errors->first('sun_end', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('closed_weekdays') ? 'has-error' : ''}}">
                {!! Form::label('closed_weekdays',  __('bck_appsetting.Weekdays_Closed') , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('closed_weekdays[]',
                     array(
                        '1' =>  __('bck_appsetting.Monday') ,
                        '2' =>  __('bck_appsetting.Tuesday') ,
                        '3' =>  __('bck_appsetting.Wendsday') ,
                        '4' =>  __('bck_appsetting.Thursday') ,
                        '5' =>  __('bck_appsetting.Friday') ,
                        '6' =>  __('bck_appsetting.Saturday') ,
                        '0' =>  __('bck_appsetting.Sunday') ,
                        ),explode(',', $appsetting->closed_weekdays),['class' => 'form-control','multiple'=>'multiple']); !!}

                    {!! $errors->first('closed_weekdays', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('disabled_dates') ? 'has-error' : ''}}">
                {!! Form::label('disabled_dates', __('bck_appsetting.Holidays'), ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::hidden('disabled_dates', null, ['class' => 'form-control adddesableddays']) !!}
                    {!! $errors->first('disabled_dates', '<p class="help-block">:message</p>') !!}
                    <div id="mdp-demo"></div>
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit( __('bck_appsetting.Aktualisieren'), ['class' => 'btn btn-primary form-control']) !!}
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

<script src="{{ URL::asset('/backend/vendors/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('backend/vendors/multipledatepicker/jquery-ui.multidatespicker.js') }}"></script>
<script src="{{ URL::asset('/frontend/js/jquery.datetimepicker.full.min.js') }}"></script>
<script>

   $(document).ready(function() {// everything comes under document.ready

        var today = new Date();
            var y = today.getFullYear();
            $('#mdp-demo').multiDatesPicker({
                altField: '#disabled_dates',
                addDates: ['{!!$appsetting->disabled_dates!!}'],
                numberOfMonths: [3,4],
                defaultDate:{{\Carbon\Carbon::now('Europe/Berlin')->addMinutes(20)->format('d/m/Y') }}
            });
            jQuery('.time_pciker_max').datetimepicker({
               format:'H:i:s',
               datepicker:false
            });

  });

    </script>
@endsection
