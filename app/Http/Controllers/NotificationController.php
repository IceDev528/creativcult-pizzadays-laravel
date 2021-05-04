<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Session;
use Sentinel;
class NotificationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {	
    	
    	if( isset($request->only ) == 'unread') {
    		 
    		$notifications= Sentinel::getUser()->unreadNotifications()->paginate(7);
    	}else{
    		$notifications= Sentinel::getUser()->notifications()->paginate(7);
    	}
    	
        return view('backEnd.notification.index',compact('notifications'));
    }

    public function show(Request $request,$id)
    {
    	$notificationOne = Sentinel::getUser()->notifications()->findOrFail($id);
        if( isset($request->only ) == 'unread') {
    		$notifications= Sentinel::getUser()->unreadNotifications()->paginate(7);
    	}else{
    		$notifications= Sentinel::getUser()->notifications()->paginate(7);
    	}
    	$notificationOne->markAsRead();
        return view('backEnd.notification.index',compact('notifications','notificationOne'));
    }
    public function destroy(Request $request,$id)
    {
       
    	$notification =  Sentinel::getUser()->notifications()->findOrFail($id);
		$notification->delete();
        Session::flash('message',  __('messages.delete_notifications'));
        Session::flash('status', 'success');

        return redirect()->route('notification.index');
    }
}
