<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use DB ;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

	}

    public function login(Request $request)
    {
        $status=false;
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>$status ,'data'=>array() ,'messages'=>$validator->errors()->all()],200);
        }
        $data=$request->all();
        $result=Auth()->guard()->attempt(['email'=>$data['email'],'password'=>$data['password']]);
         $response=['success'=>$result];
         if ($result) {
			 if(!Auth()->user()->hasRole('مالك'))
			 {
				 $messages[]='الحساب ليس حساب مالك';
				return response()->json(['status'=>$status ,'data'=>array() ,'messages'=>$messages],200);
			 }
			$User=Auth()->user();
			$User->generateToken();
			$response['user']=$User->with('salon');
			$response['status']=true;
         }
         return response()->json($response,200);
    }

    public function register(Request $request)
    {
	   $response['data']=array();
	   $response['status']=false;
			
		$validator = Validator::make($request->all(), [
       'email' => 'required|string|email|max:255|unique:users',
	   'password' => 'required|string|confirmed',
	   'name' => 'required|string',
	   'phone' => 'required|string',
	   'address' => 'required|string',
	   'city' => 'required|string',
	   'lat' => 'nullable',
	   'lng' => 'nullable',
		]);
    
	   if ($validator->fails()) {
			    $response['messages']=$validator->errors()->all();
                return response()->json($response,200);
       }
	   $data=$request->all();

	   $user = new User;
	   $user->email=$data['email'];
	   $user->name=$data['name'];
	   $user->address=$data['address'];
	   $user->city=$data['city'];
	   $user->lat=isset($data['lat'])?$data['lat']:'';
	   $user->lng=isset($data['lng'])?$data['lng']:'';
	   $user->password= Hash::make($data['password']);
	   $user->phone=$data['phone'];
	   $user->save();
	   $user->assignRole('مالك');

	   $result=Auth()->guard()->attempt(['email'=>$data['email'],'password'=>$data['password']]);
	   $response['status']=$result;
	   if ($result) {
			$Users=Auth()->user();
			$Users->generateToken();
			$response['usser']=$Users;
	    }

		return response()->json($response,200);
    }

	public function createSalon(Request $request)
    {
	   $response['data']=array();
	   $response['status']=false;
			
		$validator = Validator::make($request->all(), [
       'image' => 'required|string',
	   'name' => 'required|string',
	   'address' => 'required|string',
	   'city' => 'required|string',
	   'lat' => 'nullable',
	   'lng' => 'nullable',
		]);
    
	   if ($validator->fails()) {
			    $response['messages']=$validator->errors()->all();
                return response()->json($response,200);
       }
	   $data=$request->all();

	   $token=$request->header('token');
	   $user=User::where('token',$token)->first();
	   if ($user) 
	   {
           if($user->hasRole('مالك'))
		   {
			$salon = new Salon;
			$salon->image=$data['image'];
			$salon->name=$data['name'];
			$salon->address=$data['address'];
			$salon->city=$data['city'];
			$salon->user_id=$user->id;
			$salon->sort=Salon::get()->Max('sort')+1;
			$salon->lat=isset($data['lat'])?$data['lat']:'';
			$salon->lng=isset($data['lng'])?$data['lng']:'';
			$salon->save();
			
			$response['status']=true;
			$response['user']=$user->with('salon');
		   }else
		   {
			$response['messages']=['حسابك ليس جساب مالك'];
		   }
	   }else
	   {
		$response['messages']=['المستخدم غير موجود'];

	   }

	   

		return response()->json($response,200);
    }
	public function update(Request $request)
    {
	   $response['data']=array();
	   $response['status']=false;
			   
	   $token=$request->header('token');
	   $user=User::where('token',$token)->first();
	   if ($user) 
	   {
		$validator = Validator::make($request->all(), [
       'email' => 'nullable|string|email|unique:users,id,'.$user->id,
	   'password' => 'nullable|string|confirmed',
	   'name' => 'nullable|string',
	   'phone' => 'nullable',
	   'city' => 'nullable',
	   'address' => 'nullable',
	   'lat' => 'nullable',
	   'lng' => 'nullable',
		]);
	   if ($validator->fails()) {
			    $response['messages']=$validator->errors()->all();
                return response()->json($response,200);
       }
	   if(isset($request->name))
	   $data['name']=$request->name;
	   if(isset($request->password))
	   $data['password']=$request->password;
	   if(isset($request->phone))
	   $data['phone']=$request->phone;
	   if(isset($request->email))
	   $data['email']=$request->email;
	   if(isset($request->address))
	   $data['address']=$request->address;
	   if(isset($request->city))
	   $data['city']=$request->city;
	   if(isset($request->lat))
	   $data['lat']=$request->lat;
	   if(isset($request->lng))
	   $data['lng']=$request->lng;

       $user->update($data);
	   $response['status']=true;
       $response['user']=$user;
		return response()->json($response,200);
	  }
	 return response()->json($response,200);

    }

	public function updateSalon(Request $request)
    {
	   $response['data']=array();
	   $response['status']=false;
			   
	   $token=$request->header('token');
	   $user=User::where('token',$token)->first();
	   if ($user) 
	   {
		$validator = Validator::make($request->all(), [
       'image' => 'nullable|string',
	   'name' => 'nullable|string',
	   'city' => 'nullable',
	   'address' => 'nullable',
	   'lat' => 'nullable',
	   'lng' => 'nullable',
	   'salon_id' => 'required',
		]);
	   if ($validator->fails()) {
			    $response['messages']=$validator->errors()->all();
                return response()->json($response,200);
       }
	   if(isset($request->name))
	   $data['name']=$request->name;
	   if(isset($request->phone))
	   $data['phone']=$request->phone;
	   if(isset($request->image))
	   $data['image']=$request->image;
	   if(isset($request->address))
	   $data['address']=$request->address;
	   if(isset($request->city))
	   $data['city']=$request->city;
	   if(isset($request->lat))
	   $data['lat']=$request->lat;
	   if(isset($request->lng))
	   $data['lng']=$request->lng;

       Salon::find($request->salon_id)->update($data);
	   $response['status']=true;
       $response['user']=$user->with('salon');
		return response()->json($response,200);
	  }
	 return response()->json($response,200);

    }
    public function dataUser(Request $request)    
	{
		$response['status']=false;
		$token=$request->header('token');

		$user=User::where('token',$token)->first();
		if ($user) 
		{
			$response['user']=$user->with('salon');
			$response['status']=true;
			
		}
		return response()->json($response,200);
			 
	}
           
    public function logout(Request $request)
    {
		$masseges=array() ;
		$response['status']=false;
		$token=$request->header('token');

		$usertoken=User::where('token',$token)->first();
		if ($usertoken)
			{
			$usertoken->update([
				'token'=>null
			]);
			$response['messages']="تم تسجيل الخروج بنجاح";
			$response['status']=true;
		} else
			{
			$response['messages']="الحساب غير موجود";
			$response['status']=false;
		}
		return response()->json($response,200);
    }
}
