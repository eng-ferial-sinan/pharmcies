<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\setting;

class SettingController extends Controller
{
    //
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $info = setting::first();
        if ($info==null) {
            $info = new setting;
        }

    return view('admin.setting.index')->with('info',$info);
    }
    // public function index1()
    // {
    //     $info = setting::first();

    // return view('admin.setting.index1')->with('info',$info);
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    // public function show()
    // {
    //     return view('admin.setting.other');
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $info = setting :: find($request->input('num'));
        $info->nameAr =  $request->input('nameAr');
        $info->nameEn =  $request->input('nameEn');
        $info->address =  $request->input('address');
        $info->phone =  $request->input('phone');
        $info->email =  $request->input('email');
       
        // if($request->hasFile("url")){
        //     $image=$request->file('url');
        //     $name=time().$image->getClientOriginalName();
        //     Image::make($image->getRealPath())->interlace()->resize(230, 66)->save(public_path('/images/'. $name), 80);
        //    $info->url=url('/images/'.$name);
        //               // $smallpath= "/storage/users_thumb_".$fileNameToStore;
        //         // Image::make($imagename)->resize(450, 350)->save( public_path($smallpath),100 );
        //     }
            

        $info->save();
        return back()->with('success','تم حفظ  بنجاح');
    }
    public function update1(Request $request)
    {
        // $info = setting :: first();
        // $info->f_title =  $request->input('f_title');
        // $info->s_title =  $request->input('s_title');
        // $info->desc =  $request->input('desc');
        // $info->save();
        // return back()->with('success','تم حفظ  بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(setting $setting)
    {
        //
    }
}
