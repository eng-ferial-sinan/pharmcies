<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\setting ;
use App\Models\medicine ;
use App\Models\Category;
use App\Models\User;
use App\Models\Pharmacy;
use App\Models\usertoken;
use App\Http\Controllers\Controller;
use DB ;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $setting_date = $request->input('setting_date')?$request->input('setting_date'):date('Y-m-d');
       
                $data=array() ;
                $deleted=array() ;
                $data['categories']= category::select('id','name','updated_at as date')->where('updated_at','>',$category_date)->get() ; 
                $data['medicines'] = medicine::select('id','name','category_id','traite','demerites','relics','price','production_date','expiry_date','updated_at as date')->where('updated_at','>',$medicine_date)->get();
                $data['settings']= setting::select('id','nameAr','nameEn','email','address','phone','updated_at as date')->where('updated_at','>',$setting_date)->get(); 
                  //======================================== deleted 
                  
                  $deleted['categories']= category::withTrashed()->select('id')->whereNotNull('deleted_at')->where('updated_at','>',$category_date)->get() ; 
                  $deleted['medicines']= medicine::withTrashed()->select('id')->whereNotNull('deleted_at')->where('updated_at','>',$medicine_date)->get() ; 
                  $deleted['settings']= setting::withTrashed()->select('id')->whereNotNull('deleted_at')->where('updated_at','>',$setting_date)->get() ; 

        return response()->json( array('data'=>$data,'deleted'=>$deleted )  );

    }

    public function login(Request $request){
        $status=false;
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>$status ,'data'=>array() ,'messages'=>$validator->errors()->all()],200);
        }
        $data=$request->all();
        $result=Auth()->guard()->attempt(['email'=>$data['email'],'password'=>$data['password']]);
         $response=['success'=>$result];
         if($result)
         {
             $User=Auth()->user();
             $token=$User->generateToken();
             if(isset($request->push))
             {
                $token->push=$request->push;
                $token->save();
             }

             $response['token']=$token->token;
             $response['user']=$User;
             $response['status']=true;
         //    $response['user']['addresses']=$user->addresses;
         }
         return response()->json($response);

         }

         public function register(Request $request){
       
            $status=false;
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|',
                'password' => 'required|string|confirmed',
                'name' => 'required|string',
                'pharmacy_name' => 'required|string',
                'phone' => 'required|string',
                'address' => 'required|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['status'=>$status ,'data'=>array() ,'messages'=>$validator->errors()->all()],200);
            }
            $data=$request->all();

            $user = new User;
            $user->email=$data['email'];
            $user->name=$data['name'];
            $user->password= Hash::make($data['password']);
            $user->phone=$data['phone'];
            $user->save();

            $pharmacy =new pharmacy;
            $pharmacy->name=$request->pharmacy_name;
            $pharmacy->user_id=$user->id;
            $pharmacy->address=$request->address;
            $pharmacy->save();

            $result=Auth()->guard()->attempt(['email'=>$data['email'],'password'=>$data['password']]);
             $response=['status'=>$result];
             if($result)
             {
                 $User=Auth()->user();
                 $token=$User->generateToken();
                 if(isset($request->push))
                 {
                    $token->push=$request->push;
                    $token->save();
                 }
                 $response['token']=$token->token;
                 $response['user']=$User;
             //    $response['user']['addresses']=$user->addresses;
             }
             return response()->json($response);
    
             }

             public function dataUser(Request $request)
             {
                $response['status']=false;
                $token=$request->header('token');
                $usertoken=usertoken::where('token',$token)->first();
                if($usertoken)
                {
                 $user_id=$usertoken->user_id;
                 $user=User::find($user_id);
                 $response['token']=$token;
                 $response['user']=$user;
                 if($user->pharmacy)
                 $response['pharmacy']=$user->pharmacy;
                 $response['status']=true;
                }
                return response()->json($response);


             }
    
}
