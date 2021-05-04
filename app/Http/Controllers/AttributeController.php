<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Attribute;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class AttributeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $attribute = Attribute::all();

        return view('backEnd.attribute.index', compact('attribute'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Attribute::create($request->all());

        Session::flash('message', __('messages.Attribute_added'));
        Session::flash('status', 'success');

        return redirect('attribute');
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
        $attribute = Attribute::findOrFail($id);

        return view('backEnd.attribute.show', compact('attribute'));
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
        $attribute = Attribute::findOrFail($id);

        return view('backEnd.attribute.edit', compact('attribute'));
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
        
        
        $attribute = Attribute::findOrFail($id);
        $attribute->update($request->all());

        Session::flash('message', __('messages.Attribute_updated'));
        Session::flash('status', 'success');

        return redirect('attribute');
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
        $attribute = Attribute::findOrFail($id);

        $attribute->delete();

        Session::flash('message',  __('messages.Attribute_deleted'));
        Session::flash('status', 'success');

        return redirect('attribute');
    }

}
