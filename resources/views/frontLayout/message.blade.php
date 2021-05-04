
@if (Session::has('message'))
 <div class="alert alert-{{(Session::get('status')=='error')?'danger':Session::get('status')}} sessions-hide" alert-dismissable fade in >
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {!! Session::get('message') !!}
  </div>
@endif

