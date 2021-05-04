<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AppSetting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\View\View;
class AppSettingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $appsetting = AppSetting::firstOrCreate(['id' => 1]);
        //tes end
        return view('backEnd.appsetting.edit', compact('appsetting'));
    }

    

    public function shareSettings(View $view,$value='')
    {
         $appsetting = AppSetting::firstOrCreate(['id' => 1]);
         $view->with('appsettings', $appsetting);

    }

    
    public function update($id, Request $request)
    {
        
        $appsetting = AppSetting::findOrFail($id);
        $appsetting->update($request->all());

        Session::flash('message',  __('messages.app_settings_updated'));
        Session::flash('status', 'success');

        return redirect('appsetting');
    }



}
