<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\zipCode;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use App\Location;
class zipCodeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $zipcode = zipCode::all();

        return view('backEnd.zipcode.index', compact('zipcode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $locations=Location::get()->pluck('name','id');
        return view('backEnd.zipcode.create',compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        zipCode::create($request->all());

        Session::flash('message', __('messages.zip_code_added'));
        Session::flash('status', 'success');

        return redirect('zipcode');
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
        $zipcode = zipCode::findOrFail($id);

        return view('backEnd.zipcode.show', compact('zipcode'));
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
        $zipcode = zipCode::findOrFail($id);
        $locations=Location::get()->pluck('name','id');
        return view('backEnd.zipcode.edit', compact('zipcode','locations'));
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
        
        $zipcode = zipCode::findOrFail($id);
        $zipcode->update($request->all());

        Session::flash('message', __('messages.zip_code_updated'));
        Session::flash('status', 'success');

        return redirect('zipcode');
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
        $zipcode = zipCode::findOrFail($id);

        $zipcode->delete();

        Session::flash('message', __('messages.zip_code_deleted'));
        Session::flash('status', 'success');

        return redirect('zipcode');
    }

}
