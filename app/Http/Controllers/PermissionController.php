<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    //
    function __construct()
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
     $permissions = Permission::orderBy('id','DESC')->get();
        // ,compact('roles')
        return view('admin.roles.index');
        $permission = Permission::all();
        return view('admin.roles.index')->with('$permissions',$permission);
      
          
        // $permission = Role::orderBy('id','DESC')->get();
        // return view('admin.roles.index');
        // ,compact('$permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $permission = Permission::all();
        // return view('roles.create',compact('permission'));
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
            'name' => 'required|string|,name',
            // 'permission' => 'required',
        ]);
        // dd($request->input('permission'));
        $role = Role::create(['name' => $request->input('name')]);
        // $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
                        ->with('success','تم انشاء الصلاحيات');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            // 'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();


        // $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
                        ->with('success','تم التحديث');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     DB::table("permissions")->where('id',$id)->delete();
    //     return redirect()->route('roles.index')
    //                     ->with('success','تم حذف نوع المستخدم');
    // }
}
