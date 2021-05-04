<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
class PageController extends Controller
{
    public function Location($value='')
    {
    	return view('frontEnd.locations');
    }
    public function Aboutus($value='')
    {
    	return view('frontEnd.aboutus');
    }
    public function ShopFunction($value='')
    {
        $products = Product::all();
        $categories = Category::all();
        $selectCat=false;
       return view('frontEnd.shop',compact('products','categories','selectCat'));
    }
    public function ShopByCategory($slug='')
    {
        $selectCat=Category::where('slug',$slug)->firstOrFail();
    	$products = Product::all();
    	$categories = Category::all();
    	return view('frontEnd.shop',compact('products','categories','selectCat'));
    }

}
