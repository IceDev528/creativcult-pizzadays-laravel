@extends('backLayout.app')
@section('title')
{{ __('bck_category.Create_New_Category') }}
@stop

@section('content')

    <h1>{{ __('bck_category.Create_New_Category') }}</h1>
    <hr/>

    {!! Form::open(['url' =>  __('bck_category.category') , 'class' => 'form-horizontal']) !!}

          <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name',  __('bck_attribute.Name').':' , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('is_parent') ? 'has-error' : ''}}">
                {!! Form::label('is_parent',  __('bck_category.Is_Parent').':', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                                <div class="checkbox">
                <label>{!! Form::radio('is_parent', '1',true) !!} {{ __('bck_category.Yes')}} </label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('is_parent', '0' ) !!}  {{__('bck_category.No')}} </label>
            </div>
                    {!! $errors->first('is_parent', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : ''}} parent_category">
                {!! Form::label('parent_id',  __('bck_category.Parent_Category') , ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('parent_id', $parents, null, ['class' => 'form-control','placeholder'=> __('bck_category.Select_category_parent') ]) !!}
                    {!! $errors->first('parent_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                {!! Form::label( __('bck_category.description') ,  __('bck_category.Description').':', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea( __('bck_category.description') , null, ['class' => 'form-control']) !!}
                    {!! $errors->first( __('bck_category.description') , '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit(__('auth.Create') , ['class' => 'btn btn-primary form-control']) !!}
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
    if($('#is_parent').is(':checked')) {
     $('.parent_category').hide();
    }else{
        $('.parent_category').show();
    }
    $('input[name^="is_parent"]').change(function () {if (this.value == 1) {
       $('.parent_category').hide();
     }else{
         $('.parent_category').show();
     }});
</script>
@endsection
