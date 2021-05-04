<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use App\Product;
use App\Attribute;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Image;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
           
            'name' => 'required|max:35|min:2|string',
            'category_id' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png,jpg,gif',
        ]);
    }

    public function index()
    {
        $product = Product::all();

        return view('backEnd.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $categories=Category::pluck('name','id');
        $attribute=Attribute::pluck('name','id');
        return view('backEnd.product.create',compact('categories','attribute'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
         $DS    = DIRECTORY_SEPARATOR;
        $absolutePAth = '/upload'.$DS.'product'.$DS;
        $uploadPath = public_path($absolutePAth);

        if ($this->validator($request)->fails()) {
            return redirect()->back()
                        ->withErrors($this->validator($request))
                        ->withInput();
        }

        $allatributes=$request->get('attributes');
        $allPrices=$request->price;
        $collection = collect($allatributes);
        $combined = $collection->combine($request->price);
        $Atributes=$combined->all();

        foreach ($allatributes as $key => $atribute) {
            $result[$atribute]=['price' => $allPrices[$key]];
           
        }

           
           
        $newProduct=new Product;

        $newProduct->name = $request->name;

        $newProduct->slug =$this->uniquesSlug($request->name);
        $newProduct->category_id =$request->category_id;
        $newProduct->description =$request->description;
        $uploadImage = Input::file('image');
        if($uploadImage){
                    
                    $imagename = str_random(3) . '_' . $uploadImage->getClientOriginalName();
                    $name      = $this->sanitizeFilename($imagename);

                    $uploadImage->move($uploadPath, $name);
                    //start resize
                    $thumb = Image::make($uploadPath.$DS.$name)->resize(308, null, function ($constraint) {
                                $constraint->aspectRatio();
                             });
                    $thumb->save($uploadPath.$DS.'thumb_'.$name, 90);
                    

              $newProduct->image=$name;
              $newProduct->path=$absolutePAth;
        }

       $newProduct->save();

        $newProduct->attribute()->sync($result);

        Session::flash('message',  __('messages.product_Added'));
        Session::flash('status', 'success');

        return redirect('product');
    }
    public function uniquesSlug($title='',$notIn=false)
    {
        $check='';
        if($title){
            do
            {
                
                $slug = str_slug($title.$check, '-');
                if ($notIn) {
                  $ProductSlug = Product::where('slug', $slug)->whereNotIn('id',[$notIn])->get();
                }else{
                    $ProductSlug = Product::where('slug', $slug)->get();
                }
                
                $check++; 
            }
            while(!$ProductSlug->isEmpty());

            return $slug;
        }

        return false;
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
        $product = Product::findOrFail($id);

        return view('backEnd.product.show', compact('product'));
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
        $product = Product::findOrFail($id);
        $categories=Category::pluck('name','id');
        $attribute=Attribute::pluck('name','id');
        return view('backEnd.product.edit', compact('product','categories','attribute'));
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
         $DS    = DIRECTORY_SEPARATOR;
        $absolutePAth = '/upload'.$DS.'product'.$DS;
        $uploadPath = public_path($absolutePAth);

        $updateproduct = Validator::make($request->all(), [
            'name' => 'required|max:35|min:2|string',
            'category_id' => 'required',
        ]);

        if ($updateproduct->fails()) {
            return redirect()->back()
                        ->withErrors($updateproduct)
                        ->withInput();
        }

        $allatributes=$request->get('attributes');
        $allPrices=$request->price;
        $collection = collect($allatributes);
        $combined = $collection->combine($request->price);
        $Atributes=$combined->all();

        foreach ($allatributes as $key => $atribute) {
            $result[$atribute]=['price' => $allPrices[$key]];
           
        }
        
        $product = Product::findOrFail($id);
        
        $product->name = $request->name;

        $product->slug =$this->uniquesSlug($request->slug,$product->id);
        $product->category_id =$request->category_id;
        $product->description =$request->description;
        $uploadImage = Input::file('image');
        if($uploadImage){
                    
                    $imagename = str_random(3) . '_' . $uploadImage->getClientOriginalName();
                    $name      = $this->sanitizeFilename($imagename);

                    $uploadImage->move($uploadPath, $name);
                    //start resize
                    $thumb = Image::make($uploadPath.$DS.$name)->resize(308, null, function ($constraint) {
                                $constraint->aspectRatio();
                             });
                    $thumb->save($uploadPath.$DS.'thumb_'.$name, 90);
                    

              $product->image=$name;
              $product->path=$absolutePAth;
        }

        $product->update();

        $product->attribute()->sync($result);

       

        Session::flash('message', __('messages.product_updated'));
        Session::flash('status', 'success');

        return redirect('product');
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
        $product = Product::findOrFail($id);

        $product->delete();

        Session::flash('message',  __('messages.product_deleted'));
        Session::flash('status', 'success');

        return redirect('product');
    }
    public function sanitizeFilename($filename = '') {
        // a combination of various methods
        // we don't want to convert html entities, or do any url encoding
        // we want to retain the "essence" of the original file name, if possible
        // char replace table found at:
        // http://www.php.net/manual/en/function.strtr.php#98669
        $replace = array(
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'Ae', 'Å'=>'A', 'Æ'=>'A', 'Ă'=>'A', 'Ą' => 'A', 'ą' => 'a',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'ae', 'å'=>'a', 'ă'=>'a', 'æ'=>'ae',
            'þ'=>'b', 'Þ'=>'B',
            'Ç'=>'C', 'ç'=>'c', 'Ć' => 'C', 'ć' => 'c',
            'Ð'=>'Dj', 
            'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ę' => 'E', 'ę' => 'e',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e',
            'ƒ'=>'f', 
            'Ğ'=>'G', 'ğ'=>'g',
            'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'İ'=>'I', 'ı'=>'i', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i',
            'Ł' => 'L', 'ł' => 'l',
            'Ñ'=>'N', 'Ń' => 'N', 'ń' => 'n',
            'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'Oe', 'Ø'=>'O', 'ö'=>'oe', 'ø'=>'o',
            'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
            'Š'=>'S', 'š'=>'s', 'Ş'=>'S', 'ș'=>'s', 'Ș'=>'S', 'ş'=>'s', 'ß'=>'ss', 'Ś' => 'S', 'ś' => 's',
            'ț'=>'t', 'Ț'=>'T',
            'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'Ue',
            'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'ue', 
            'Ý'=>'Y',
            'ý'=>'y', 'ý'=>'y', 'ÿ'=>'y',
            'Ž'=>'Z', 'ž'=>'z', 'Ż' => 'Z', 'ż' => 'z', 'Ź' => 'Z', 'ź' => 'z'
        );

        $search = array(
            '@<script[^>]*?>.*?</script>@si',   /* strip out javascript */
            '@<[\/\!]*?[^<>]*?>@si',            /* strip out HTML tags */
            '@<style[^>]*?>.*?</style>@siU',    /* strip style tags properly */
            '@<![\s\S]*?--[ \t\n\r]*>@'         /* strip multi-line comments */
        );
                

        $cyr = array('ж', 'ч', 'щ',  'ш', 'ю',  'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я', 'Ж',  'Ч',  'Щ',   'Ш',  'Ю',  'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я');

        $lat = array("l", "s", 'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'q', 'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'Q');

        $filename = str_replace($cyr, $lat, $filename);
        $filename = strtr($filename, $replace);
        $filename = preg_replace($search, '', $filename);   /* Replace these elements with empty */
        // convert & to "and", @ to "at", and # to "number"
        $filename = preg_replace(array('/[\&]/', '/[\@]/', '/[\#]/'), array('-and-', '-at-', '-number-'), $filename);
        $filename = preg_replace('/[^(\x20-\x7F)]*/','', $filename); // removes any special chars we missed
        $filename = str_replace(' ', '-', $filename); // convert space to hyphen 
        $filename = str_replace('\'', '', $filename); // removes apostrophes
        $filename = preg_replace('/[^\w\-\.]+/', '', $filename); // remove non-word chars (leaving hyphens and periods)
        $filename = preg_replace('/[\-]+/', '-', $filename); // converts groups of hyphens into one
        $filename = trim($filename, '-'); // remove hyphen from begining or end of the string
        //return strtolower($filename);
        return mb_strtolower($filename,'UTF-8');
    }

}
