<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\Setting ;
use App\Models\Product ;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Plan;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $plan_date = $request->input('plan_date')?$request->input('plan_date'):date('Y-m-d');
       
                $data=array() ;
                $deleted=array() ;
                $data['plans'] = Plan::select('id','name',
                'send_messages_automatically',
                'message_reminder',
                'unlimited_messages',
                'attached_photos_video',
                'remove_ads',
                'choose_multiple_contacts',
                'unlimited_characters',
                'customize_scheduling_frequency',
                'number_of_contacts',
                'add_the_number_of_waiting_messages',
                'monthly_subscription',
                'yearly_subscription',
                'updated_at as date')->where('updated_at','>',$plan_date)->get();
                 $data['settings']= Setting::select('id','nameAr','nameEn','email','address','phone','updated_at as date')->first();
                  //======================================== deleted
                  $deleted['plans']= Plan::withTrashed()->select('id')->whereNotNull('deleted_at')->where('updated_at','>',$plan_date)->get() ;

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
