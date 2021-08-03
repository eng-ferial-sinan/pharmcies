<?php

namespace App\Http\Controllers\admin;
use Auth;
use File ;
use Image;
use \App\Models\User;
use \App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $users =User::withTrashed()->orderby('id','desc')->get();
        return view('admin.users.list')->with('users',$users) ;
    }
    public function user($id)
    {
        
    //     $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
    //     ->where("role_has_permissions.role_id",$id)
    //     ->get();
    //  $roles = Role::where('id',$id)->first();
    $users = User::whereHas("roles", function($q) use($id) { 
        $q->where("id", $id); })->withTrashed()->orderby('id','desc')->get();


        return view('admin.users.list')->with('users',$users) ;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // dd($groups);
                $roles = Role::pluck('name','name')->all();
        return view('admin.users.create',compact('roles'));

    //   return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'roles' => 'required'
        ]);


        $input = $request->all();
        // dd($request->input('roles'));
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
       
        

        return redirect()->back()
                        ->with('success','تم انشاء المستخدم');  
                    
     }
    public function profile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|confirmed',
        ]);
        $user=User::find(auth()->user()->id);
         $user->name = $request->input('name');
         $user->phone = $request->input('phone');
         $user->password = Hash::make($request->input('password'));

         $user->save();

         return  back()-> with('success','تم حفظ التعديلات ');    
   
    }
    public function saveimage(Request $request)
    {
         if($request->hasFile('myimg'))
        {
              
        $user=User::find(auth()->user()->id);

            $imagename = $request->file('myimg');
            $temp =$user->image ; 
            $fileNameToStore= 'user_sama'.time().'.jpg';
            $largepath= "/storage/".$fileNameToStore;
            Image::make($imagename)->save( public_path($largepath) );
            $smallpath= "/storage/users_thumb_".$fileNameToStore;
            Image::make($imagename)->resize(450, 350)->save( public_path($smallpath),100 ); 
            $user->url= $smallpath;
            $user->save();

            File::delete(public_path($temp ));
                     
         return  back()-> with('success','تم حفظ التعديلات ');    
   
        }
    return  back()-> with('error','يرجي التأكد م صحة الملف ');    
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::whereHas("roles", function($q) use($id) { 
            $q->where("id", $id); })->withTrashed()->orderby('id','desc')->get();
        return view('admin.users.list')->with('users',$users) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles?$user->roles->pluck('name','name')->all():0;

         return view('admin.users.edit',compact('user','roles','userRole'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            // 'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        
        return redirect()->back()
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =  User::find($id);
        
            if(auth()->user()->id == $user->id){
                return redirect('/admin/home')->with('error','غير مصرح');            
            }
        $user->delete();
         
        
        
        return back()-> with('success','تم حذف  '.$user->name.' المستخدم :'.$user->email);    
   
    }

    //changestatus 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changestatus ($id)
    {
    $user =  User::find($id);
    if($user->status==1)
    {
        $user->status=2;
    }else
    {
        $user->status=1;
    }
    $user->save();
     
        return  back()->with('success','تم تغير حالة   '.$user->name.' المستخدم :'.$user->email); ;
   
    } public function changepriv (Request $request , $id )
    {

        $this->validate($request,[
        'role' => 'required|numeric|max:6'  
        ]);      
        

    $user =  User::find($id);
         $role= $request->input('role');     
         $user->usertype=$role;
    $user->save();
     
        return  back()->with('success','تم تغير نوع   '.$user->name.' المستخدم :'.$user->email); ;
   
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restorUser($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();        

        return  back()->with('success','تم استعادة    '.$user->name.' المستخدم :'.$user->email);;
   
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //froceDestroy
    public function froceDestroy($id)
    {
        $user = User::withTrashed()->find($id);
    
        if($user->url != null){
            File::delete(public_path($user->url));
        }
        
        $user->forceDelete();

        return  back()->with('success','تم حذف    '.$user->name.' المستخدم :'.$user->email);;
   
    } 
}
