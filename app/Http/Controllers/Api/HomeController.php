<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\Setting ;
use App\Models\Product ;
use App\Models\Category;
use App\Http\Controllers\Controller;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category_date = $request->input('category_date')?$request->input('category_date'):date('Y-m-d');
        $product_date = $request->input('product_date')?$request->input('product_date'):date('Y-m-d');
       
                $data=array() ;
                $deleted=array() ;
                $data['categories']= Category::select('id','name','image','sort','updated_at as date')->where('updated_at','>',$category_date)->get() ;
                $data['products'] = Product::select('id','name','desc','image','category_id','price','sort','updated_at as date')->where('updated_at','>',$product_date)->get();
                $data['settings']= Setting::select('id','nameAr','nameEn','email','address','phone','updated_at as date')->first();
                  //======================================== deleted
                  $deleted['categories']= Category::withTrashed()->select('id')->whereNotNull('deleted_at')->where('updated_at','>',$category_date)->get() ;
                  $deleted['products']= Product::withTrashed()->select('id')->whereNotNull('deleted_at')->where('updated_at','>',$product_date)->get() ;

        return response()->json(array('data'=>$data,'deleted'=>$deleted ),200);
    }
}
