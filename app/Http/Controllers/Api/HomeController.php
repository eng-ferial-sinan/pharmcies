<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Models\setting ;
use App\Models\medicine ;
use App\Models\Category;
use App\Http\Controllers\Controller;
use DB ;
use App\Models\User;
use App\Models\usertoken;
use App\Models\Pharmacy;
use Validator;
use App\Models\visit;
use App\Notifications\VisitNotification;
use Illuminate\Support\Facades\Notification;

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
                $data['medicines'] = medicine::select('id','name','image','category_id','traite','demerites','relics','price','production_date','expiry_date','updated_at as date')->where('updated_at','>',$medicine_date)->get();
                $data['settings']= setting::select('id','nameAr','nameEn','email','address','phone','updated_at as date')->first();
                  //======================================== deleted
                  
                  $deleted['categories']= category::withTrashed()->select('id')->whereNotNull('deleted_at')->where('updated_at','>',$category_date)->get() ;
                  $deleted['medicines']= medicine::withTrashed()->select('id')->whereNotNull('deleted_at')->where('updated_at','>',$medicine_date)->get() ;

        return response()->json(array('data'=>$data,'deleted'=>$deleted ),200);
    }

    public function pharmacies(Request $request)
    {
        $response['status']=false;
        $token=$request->header('token');
        $pharmacy_date = $request->input('pharmacy_date')?$request->input('pharmacy_date'):date('Y-m-d');
        $usertoken=usertoken::where('token',$token)->first();
        if ($usertoken) {
                $user_id=$usertoken->user_id;
                $user=User::find($user_id);
                if($user->user_type=="مندوب طبي")
                {
                $response['data']['Pharmacy'] = Pharmacy::where('updated_at','>',$pharmacy_date)->get();
                $response['deleted']['Pharmacy']= Pharmacy::withTrashed()->select('id')->whereNotNull('deleted_at')->where('updated_at','>',$pharmacy_date)->get() ;
                $response['status']=true;
                }
                }
               return response()->json($response,200);
    
  }

  public function visit(Request $request)
    {
        $response['status']=false;
        $token=$request->header('token');
        $pharmacy_id = $request->input('pharmacy_id')??null;
        $validator = Validator::make($request->all(), [
          'lat' => 'required',
          'lng' => 'required',
        ]);

          if ($validator->fails()) {
              $response['messages']=$validator->errors()->all();
              return response()->json($response,200);
          }
        $usertoken=usertoken::where('token',$token)->first();
        if ($usertoken) {
                $user_id=$usertoken->user_id;
                $user=User::find($user_id);
                if($user->user_type=="مندوب طبي")
                {
                $pharmacy = Pharmacy::find($pharmacy_id);
                if(!$pharmacy)
                {
                  return response()->json($response,200);

                }
                $distance =round((round( 
                  ( 3959 * acos( cos( deg2rad($request->lat) ) * cos( deg2rad( $pharmacy->lat ) )
                    * cos( deg2rad( $pharmacy->lng  ) - deg2rad($request->lng) ) + sin( deg2rad($request->lat) ) 
                    * sin( deg2rad( $pharmacy->lat ) ) ) ),5 ) *1.609344 ),2)   ;
                    $distance=$distance*1000;
                    if($distance>20)
                {
                  $response['messages']=["الصيدلية بعيدة عنك"];
                  return response()->json($response,200);
                }
                // return response()->json($distance,200);

                $visit=new visit;
                $visit->user_id=$user->id;
                $visit->pharmacy_id=$pharmacy->id;
                $visit->save();
                $users=User::where('user_type','مدير')->get();
                Notification::send($users, new VisitNotification($visit,$user,$pharmacy));

                $response['messages']=["تم تسجيل الزيارة"];
                $response['status']=true;
                }
                }
               return response()->json($response,200);
    
  }
}
