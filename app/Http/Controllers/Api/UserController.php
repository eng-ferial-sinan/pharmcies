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

        return response()->json(array('data'=>$data,'deleted'=>$deleted ));
    }

    public function login(Request $request)
    {
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
         if ($result) {
			$User=Auth()->user();
			$token=$User->generateToken();
			if (isset($request->push)) {
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

         public function register(Request $request)
         {
       
	   $response['data']=array();
	   $response['status']=false;
			
		$validator = Validator::make($request->all(), [
	   'email' => 'required|string|email|',
	   'password' => 'required|string|confirmed',
	   'name' => 'required|string',
	   'pharmacy_name' => 'required|string',
	   'phone' => 'required|string',
	   'address' => 'required|string',
		]);
    
	   if ($validator->fails()) {
			    $response['messages']=$validator->errors()->all();
                return response()->json($response,200);
       }
	   $data=$request->all();

	   $user = new User;
	   $user->email=$data['email'];
	   $user->name=$data['name'];
	   $user->password= Hash::make($data['password']);
	   $user->phone=$data['phone'];
	   $user->user_type="صيدلية";
	   $user->save();
	   $user =$user->fresh();
	   $pharmacy =new pharmacy;
	   $pharmacy->name=$request->pharmacy_name;
	   $pharmacy->user_id=$user->id;
	   $pharmacy->address=$request->address;
	   if ($request->hasFile('image')) {
			$imagename = $request->file('image');
			$fileNameToStore= "pharmacy_" .time().'.jpg';
			$imagename->move(public_path('pharmacies/'), $fileNameToStore);
			$pharmacy->image='/pharmacies/'.$fileNameToStore;
	   }
	   $pharmacy->save();

	   $result=Auth()->guard()->attempt(['email'=>$data['email'],'password'=>$data['password']]);
	   $response['status']=$result;
	   if ($result) {
			$User=Auth()->user();
			$token=$User->generateToken();
			if (isset($request->push)) {
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
	   if ($usertoken) {
                 $user_id=$usertoken->user_id;
                 $user=User::find($user_id);
                 $response['token']=$token;
                 $response['user']=$user;
                 if ($user->pharmacy)
                 $response['pharmacy']=$user->pharmacy;
                 $response['status']=true;
	   }
	   return response()->json($response);
             }
           
             public function logout(Request $request)
             {
	   $masseges=array() ;
	   $response['status']=false;
	   $token=$request->header('token');

	   $usertoken=usertoken::where('token',$token)->first();
	   if ($usertoken) {
                 $usertoken->delete();
                 $response['messages']="تم تسجيل الخروج بنجاح";
                 $response['status']=true;
	   } else {
						   $response['messages']="الحساب غير موجود";
						   $response['status']=false;
	   }
	   return response()->json($response);
             }

            
                public function store(Request $request)
                {
		$status=false;
		$validator = Validator::make($request->all(), [
'email' => 'required|string|email|',
'password' => 'required|string|confirmed',
'name' => 'required|string',
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
		$user->user_type="مندوب";
		$user->save();
        
		$result=Auth()->guard()->attempt(['email'=>$data['email'],'password'=>$data['password']]);
$response=['status'=>$result];
if ($result) {
						$User=Auth()->user();
						$token=$User->generateToken();
						if (isset($request->push)) {
				$token->push=$request->push;
				$token->save();
						}
						$response['token']=$token->token;
						$response['user']=$User;
					//    $response['user']['addresses']=$user->addresses;
}
return response()->json($response);
                }
        
         
             public function update(Request $request, $id = null)
             {
		$data=json_decode(($request->input('user')));
	//    dd($request);
		// return response()->json($request);
		$user = User::where('email',$data->id)->first();
		$id='0' ;
		$largepath="";
		$filename=null;
		if (!is_null($user) and $request->input('id')) {
		 if ($request->hasFile('image')) {
                     $media=$request->file('image') ;
                     $filename = 'super_'.time().'.jpg';
                     $largepath=  '/storage/'.$filename;
                     Image::make($media)->save(public_path($largepath));
                     File::delete(public_path().$user->url);
                     $md5=    md5_file(public_path($largepath));
		 }
						   if ($filename==null) {
	 $user->name=$data->name;
	// $user->phone=$data->phone;
	 $user->save();
						   } else {
$user->name=$data->name;
				//  $user->token=isset($request['token'])? $request['token'] :$user->token;
$user->url= $largepath;
$user->save();
				           }
								  $user->assignRole('مندوب');
         
                  
              $user = User::select('email as id','name','address',DB::raw("concat('".url('/')."',url) as url"),'phone','updated_at as date')->where('id',$user->id)->first();
		} else {
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
if (!is_null($user)) {
							  if (isset($data['token']) and !empty($data['token'])) {
	 // dd($data['token']);
$user->token=$data['token'];
$user->save();
						      }
         
							  $status= 1 ;
							  $response_data1=User::select('id','email','name','address','url','phone','updated_at as date')->where('id',$user->id)->first();
							  $masseges[]="تم تحديث توكن المستخدم بنجاح";
} else {
							  $masseges[]="  المستخدم غير موجود  ";
}
return response()->json(['status'=>$status ,'data'=>$response_data1 ,'messages'=>$masseges]);
             }
}
