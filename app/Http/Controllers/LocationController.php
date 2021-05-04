<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Location;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Sentinel;

class LocationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $location = Location::all();
        return view('backEnd.location.index', compact('location'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $role = Sentinel::findRoleBySlug('manager');
        $managers = $role->users()->has('location','<', 1)->get()->pluck('email','id');

        return view('backEnd.location.create',compact('managers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Location::create($request->all());
        if($request->user_id){
            $user = User::findOrFail($request->user_id);
            $user->location_id=$request->user_id;
            $user->update();
        }

        Session::flash('message', __('messages.location_add'));
        Session::flash('status', 'success');

        return redirect('location');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $location = Location::findOrFail($id);

        return view('backEnd.location.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $location = Location::findOrFail($id);
        $role = Sentinel::findRoleBySlug('manager');
        $managers = $role->users()->has('location','<',1)->orWhere('id', $location->manager()->id)->get()->pluck('email','id');

        return view('backEnd.location.edit', compact('location','managers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        
        $location = Location::findOrFail($id);
        $location->update($request->all());
        if($request->user_id){
            $user = User::findOrFail($request->user_id);
            $user->location_id=$location->id;
            $user->update();
        }

        Session::flash('message', __('messages.location_updated'));
        Session::flash('status', 'success');

        return redirect('location');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);

        $location->delete();

        Session::flash('message', __('messages.location_deleted'));
        Session::flash('status', 'success');

        return redirect('location');
    }

}
