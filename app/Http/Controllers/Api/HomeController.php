<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Cart,App\Company,App\Favorite ,App\storetype,App\User,App\store ,
App\service,App\section ,App\Product,App\PurchaseDetial,App\ShippingType ,App\order,App\Address,App\Country;
use App\Models\setting ;
use App\Models\medicine ;
use App\Models\Category;
use App\Http\Controllers\Controller;
use DB ;

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
        $medicine_date = $request->input('medicine_date')?$request->input('medicine_date'):date('Y-m-d');
       
                $data=array() ;
                $deleted=array() ;
                $data['categories']= category::select('id','name','updated_at as date')->where('updated_at','>',$category_date)->get() ; 
                $data['medicines'] = medicine::select('id','name','category_id','traite','demerites','relics','price','production_date','expiry_date','updated_at as date')->where('updated_at','>',$medicine_date)->get();
                $data['settings']= setting::select('id','nameAr','nameEn','email','address','phone','updated_at as date')->first(); 
                  //======================================== deleted 
                  
                  $deleted['categories']= category::withTrashed()->select('id')->whereNotNull('deleted_at')->where('updated_at','>',$category_date)->get() ; 
                  $deleted['medicines']= medicine::withTrashed()->select('id')->whereNotNull('deleted_at')->where('updated_at','>',$medicine_date)->get() ; 

        return response()->json( array('data'=>$data,'deleted'=>$deleted )  );

    }

    
    
}
