<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
class CategoryController extends Controller
{

     protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
           
            'name' => 'required|max:35|min:2|string',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $category = Category::all();

        return view('backEnd.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {   
        $parents = Category::where('is_parent',1)->pluck('name','id');
        return view('backEnd.category.create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if ($this->validator($request)->fails()) {
            return redirect()->back()
                        ->withErrors($this->validator($request))
                        ->withInput();
        }
        
        $newCategory=new Category;
        $newCategory->name = $request->name;
        $newCategory->slug =$this->uniquesSlug($request->name);
        $newCategory->is_parent = $request->is_parent;
        $newCategory->parent_id = $request->parent_id;
        $newCategory->description = $request->description;
        $newCategory->save();

        Session::flash('message', __('messages.category_created'));
        Session::flash('status', 'success');

        return redirect('category');
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
        $category = Category::findOrFail($id);

        return view('backEnd.category.show', compact('category'));
    }
    public function uniquesSlug($title='')
    {
        $check='';
        if($title){
            do
            {
                
                $slug = str_slug($title.$check, '-');
                $category = Category::where('slug', $slug)->get();
                $check++; 
            }
            while(!$category->isEmpty());

            return $slug;
        }

        return false;
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
        $category = Category::findOrFail($id);
        $parents = Category::where('is_parent',1)->pluck('name','id');
        return view('backEnd.category.edit', compact('category','parents'));
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
        
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug =$this->uniquesSlug($request->slug);
        $category->is_parent = $request->is_parent;
        $category->parent_id = $request->parent_id;
        $category->description = $request->description;

        $category->update();

        Session::flash('message', __('messages.category_updated'));
        Session::flash('status', 'success');

        return redirect('category');
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
        $category = Category::findOrFail($id);

        $category->delete();

        Session::flash('message', __('messages.category_created'));
        Session::flash('status', 'success');

        return redirect('category');
    }

}
