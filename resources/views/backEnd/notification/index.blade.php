@extends('backLayout.app')
@section('title')
Notifications
@stop

@section('content')
<div class="">

            <!-- <div class="page-title">
              <div class="title_left">
                <h3>Inbox Design <small>Some examples to get you started</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div> -->

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Notification<small>{{Sentinel::getUser()->first_name .' '.Sentinel::getUser()->last_name}}</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-3 mail_list_column">
<!--                         <button id="compose" class="btn btn-sm btn-success btn-block" type="button">COMPOSE</button>
 -->						@foreach ($notifications as $notification)
                          <?php $data=$notification->data; ?>
	                        <a href="{{ url('notification', $notification->id) }}">
	                          <div class="mail_list">
	                            <div class="left">
	                             @if(!$notification->read_at)
	                              <i class="fa fa-circle"></i>
	                              @else
	                              <i class="fa fa-circle-o"></i>
	                              @endif
	                            </div>
	                            <div class="right">
	                              <h3>{{ $data['user']['first_name'].' '.$data['user']['last_name'] }} <small>{{ $notification->created_at }}</small></h3>
	                              <span class="time">Requested Delivery: {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i',$data['date_delivery']) ->diffForHumans(\Carbon\Carbon::now('Europe/Berlin')) }} </span>
	                               <br><span class="message">
			                         Total:  <strong>{{ $data['total'] }}</strong> {{$appsettings->currency}} <br>  
			                        </span>
	                            </div>
	                          </div>
	                        </a>
					   @endforeach
					   {{ $notifications->links() }}
                      </div>
                      <!-- /MAIL LIST -->

                      <!-- CONTENT MAIL -->
                      <div class="col-sm-9 mail_view">
                        @if(isset($notificationOne))
                         <?php $data=$notificationOne->data; ?>
                        <div class="inbox-body">
                          <div class="mail_heading row">
                            <div class="col-md-8">
                              <div class="btn-group">
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                               
                                @if (Sentinel::getUser()->hasAccess(['notification.destroy']))

					                    {!! Form::open([
					                        'method'=> 'DELETE',
					                        'url' => ['notification', $notificationOne->id],
					                        'style' => 'display:inline'
					                    ]) !!}
					                       <button class="btn btn-sm btn-default" type="submit" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
					                    {!! Form::close() !!}
					                @endif
                              </div>
                            </div>
                            <div class="col-md-4 text-right">
                              <p class="date">{{ $notification->created_at }}</p>
                            </div>
                            <div class="col-md-12">
                              <h4>{{ $data['user']['first_name'].' '.$data['user']['last_name'] }} </h4>
                            </div>
                          </div>
                          <div class="sender-info">
                            <div class="row">
                              <div class="col-md-12">
                                <strong>{{ $data['user']['first_name'].' '.$data['user']['last_name'] }}</strong>
                                <span>{{ $notification->created_at }}</span>
                                <strong> Requested Delivery: </strong>
                               	{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i',$data['date_delivery']) ->diffForHumans(\Carbon\Carbon::now('Europe/Berlin')) }}
                              </div>
                            </div>
                          </div>
                          <div class="view-mail">
                           <strong>Order status:  </strong> {{ $data['status']}} <br>
                           <strong>Payment Method:  </strong> {{ $data['method']}}
                          </div>
                          <div class="attachment">
                            
                                <div class="links">
                                  <a href="{{ url('order', $data['invoice_id']) }}">View order</a> -
                                 <a href="{{url('/').'/upload/invoice/INV-'.$data['user_id'].'-'.$data['invoice_id'].'.pdf' }}" target="_blank" class="">Download Invoice</a>
                                </div>
                          </div>
                          <div class="btn-group">
                            <button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                            <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                          </div>
                        </div>
                        @else
						@endif
                      </div>
                      <!-- /CONTENT MAIL -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@section('scripts')

@endsection
