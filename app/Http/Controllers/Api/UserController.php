<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\setting ;
use App\Models\medicine ;
use App\Models\Category;
use App\Models\User;
use App\Models\Pharmacy;
use App\Models\Order;
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
            $user->user_type="صيدلاني";                                   
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
                // return response()->json(['status'=>$status ,'token'=>$user ,'messages'=>$masseges]);


             }
           
             public function logout(Request $request)
             { 
                $masseges=array() ;
                $response['status']=false;
                $token=$request->header('token');

                $usertoken=usertoken::where('token',$token)->first();
                if($usertoken)
                {
                 $usertoken->delete();
                 $response['messages']="تم تسجيل الخوج بنجاح";
                 $response['status']=true;
                }else
                {
                 $response['messages']="الحساب غير موجود";
                 $response['status']=false;
                }
                return response()->json($response);


             }

             public function store(Request $request)
             {
                 $status=0 ;
                 $masseges=array() ;
                 $validator = Validator::make($request->all(), [
                    'image' => 'image', 
                    ]);
               
         
                 if ($validator->fails()) {
                     return response()->json(['status'=>$status ,'data'=>array() ,'messages'=>$validator->errors()->all()],200);
         
                 }
         
                 // $data=json_decode( $request['user_id'] ); 
                 // dd($data);
                 $user = User::withTrashed()->whereNotNull('deleted_at')->where('id',$request['id'])->first();      
                 if (!is_null($user)) {
                     $masseges[]="  المستخدم محذوف";
                     return response()->json(['status'=>$status ,'data'=>array() ,'messages'=>$masseges]);
         
                 }
                 $user = User::where('phone',$request['phone'])->first(); 
                 $filename=null;
                 $largepath="";
                 $response_data=array() ;
                 if(is_null($user) )
                 {
                  if($request->hasFile('image'))
                 {   
                     $media=$request->file('image') ;
                     $filename = 'super_'.time().'.jpg';             
                     $largepath=  '/storage/'.$filename;
                     Image::make($media)->save( public_path($largepath) );
                     $md5=    md5_file(public_path($largepath)); 
                 }
                        $user = new User;
                        $user->id=isset($request['id'])? $request['id'] :"";
                        $user->name=isset($request['name'])? $request['name'] :"";
                        $user->email=isset($request['email'])? $request['email'] :"";
                        $user->address=isset($request['address'])? $request['address'] :"";
                        $user->phone=isset($request['phone'])? $request['phone'] :"";                                   
                        $user->password=Hash::make(isset($request['phone'])? $request['phone'] :'password');
                        $user->url=$largepath;
                        $user->save();
                        $user->assignRole('مندوب');
         
                         $status= 1 ;
                        
                         $response_data['id'] = User::select('id as idx','name','address','url','phone','updated_at as date')->where('id',$user->id)->first();      
                         // $user=User::select('id as idx','firebase_id as id','email','name','url','phone','updated_at as date')
                         // ->where('firebase_id','=',$data->id)->first() ; 
         
                        //  $response_data['addresses']= Address::where('user_id','=',$user->id)->get() ;   
                             
                        //      $response_data['purchase']=order::where('user_id',$user->id)->get() ;                      
                        //      $purchase_ids =$response_data['purchase']->pluck('id')->all();     
                            //  $response_data['replies']=reply::whereIn('order_id',$purchase_ids)->get() ; 
                            //  $replies_id =$response_data['replies']->pluck('acount_id')->all();     
                            //  $response_data['user'] = User::select('id','name','address','url','phone','updated_at as date')
                            //  ->whereIn('id',$replies_id)->get();      
                             
                            //  unset($response_data['id']['idx']);               
                         $masseges[]="تم اضافة مستخدم جديد";
                 }else {
                     if($request->hasFile('image'))
                     {   
                         $media=$request->file('image') ;
                         $filename = 'super_'.time().'.jpg';             
                         $largepath=  '/storage/'.$filename;
                         Image::make($media)->save( public_path($largepath) );
                         File::delete(public_path().$user->url);
                         $md5=    md5_file(public_path($largepath)); 
                     }
                                        if($filename!=null) $user->url= $largepath;                          
                                        if(isset($request['name'])  ) $user->name=$request['name'];                                     
                                        if(isset($request['email'])  ) $user->email=$request['email'];                                     
                                        if(isset($request['address'])  ) $user->address=$request['address'];                                     
                                        // if(isset($request['id'])  ) $user->user_id=isset($request['id'])? $request['id'] :"";
         
                                              $user->save();
                                           
         
                     $status= 1 ;
                     $response_data['user'] = User::select('id','email','address','name','url','phone','updated_at as date')->where('id',$user->id)->first();
                     // $response_data1=User::select('firebase_id as id','email','name','url','phone','updated_at as date')->where('id',$user->id)->first();
                     $masseges[]="تم تعديل بيانات مستخدم بنجاح";     
                 }
                                         
                 return response()->json(['status'=>$status ,'data'=>$response_data ,'messages'=>$masseges]);
             }
         
             public function update(Request $request, $id=null)
             {
                 $data=json_decode( ($request->input('user')) ); 
             //    dd($request); 
                 // return response()->json($request);
                 $user = User::where('email',$data->id)->first();      
                 $id='0' ;
                 $largepath="";
                 $filename=null;
                 if(!is_null($user) and $request->input('id'))
                 {
                  if($request->hasFile('image'))
                 {   
                     $media=$request->file('image') ;
                     $filename = 'super_'.time().'.jpg';             
                     $largepath=  '/storage/'.$filename;
                     Image::make($media)->save( public_path($largepath) );
                     File::delete(public_path().$user->url);
                     $md5=    md5_file(public_path($largepath)); 
                 }
                                    if($filename==null){                           
                                         $user->name=$data->name;                                     
                                        // $user->phone=$data->phone;                               
                                         $user->save();
                                     }else 
                                          {
                                             $user->name=$data->name;  
                                            //  $user->token=isset($request['token'])? $request['token'] :$user->token;                                                                  
                                             $user->url= $largepath;
                                             $user->save();
                                           }
                                           $user->assignRole('مندوب');
         
                  
              $user = User::select('email as id','name','address',DB::raw("concat('".url('/')."',url) as url"),'phone','updated_at as date')->where('id',$user->id)->first();      
         
                 }else {
                     $id="1" ;
                     $user =1 ;
                 }
                                         
                 return response()->json(['user'=>$user]);
             }
         

             public function updateToken(Request $request)
             {
                    $status=0 ;
                     $masseges=array() ;
                     $validator = Validator::make($request->all(), [
                         'token' => 'required',
                         'user_id' => 'required',
                     ]);
         
                     if ($validator->fails()) {
                         return response()->json(['status'=>$status ,'data'=>array() ,'messages'=>$validator->errors()->all()],200);
         
                     }
         
                             $data= $request->all();  
                             $user = usertoken::where('user_id',$data['user_id'])->first();      
                             $response_data1=null ;
                             if(!is_null($user)) {
                                   
                                 if(isset($data['token']) and !empty($data['token']) ) 
                                     {                         
                                         // dd($data['token']);
                                      $user->token=$data['token'];                                     
                                       $user->save();
                                     }                       
         
                                 $status= 1 ;
                                 $response_data1=User::select('id','email','name','address','url','phone','updated_at as date')->where('id',$user->id)->first();
                                 $masseges[]="تم تحديث توكن المستخدم بنجاح";
                                
                             }
                             else
                             {
                                 $masseges[]="  المستخدم غير موجود  ";
                             }
         return response()->json(['status'=>$status ,'data'=>$response_data1 ,'messages'=>$masseges]);
         
         }
         
}
