<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\Setting ;
use App\Models\Service ;
use App\Models\Salon;
use App\Http\Controllers\Controller;
use App\Models\Promotion;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $salon_date = $request->input('salon_date')?$request->input('salon_date'):date('Y-m-d');
        $service_date = $request->input('service_date')?$request->input('service_date'):date('Y-m-d');
        $promotion_date = $request->input('promotion_date')?$request->input('promotion_date'):date('Y-m-d');
       
                $data=array() ;
                $deleted=array() ;
                $data['salon']= Salon::select('id','name','city','address','lat','lng','image','sort','updated_at as date')->where('updated_at','>',$salon_date)->get() ;
                $data['services'] = Service::select('id','name','desc','image','salon_id','price','sort','updated_at as date')->where('updated_at','>',$service_date)->get();
                $data['promotions'] = Promotion::select('id','image','salon_id','sort','updated_at as date')->where('updated_at','>',$promotion_date)->get();
                $data['settings']= Setting::select('id','nameAr','nameEn','email','address','phone','updated_at as date')->first();
                  //======================================== deleted
                  $deleted['salon']= Salon::withTrashed()->select('id')->whereNotNull('deleted_at')->where('updated_at','>',$salon_date)->get() ;
                  $deleted['services']= Service::withTrashed()->select('id')->whereNotNull('deleted_at')->where('updated_at','>',$service_date)->get() ;
                  $deleted['promotions']= Promotion::withTrashed()->select('id')->whereNotNull('deleted_at')->where('updated_at','>',$promotion_date)->get() ;

        return response()->json(array('data'=>$data,'deleted'=>$deleted ),200);
    }

    public function braintree(Request $request)
    {
        $data =array(
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        );
        return response()->json(['data'=>$data],200);
    }
}
