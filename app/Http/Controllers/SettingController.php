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
        // dd(1);
        $info = Setting::find($request->input('num'));
        $info->nameAr =  $request->input('nameAr');
        $info->nameEn =  $request->input('nameEn');
        $info->address =  $request->input('address');
        $info->phone =  $request->input('phone');
        $info->email =  $request->input('email');
        $info->lat =  $request->input('map_1');
        $info->lng =  $request->input('map_2');
        if ($request->hasFile('image')) {
            $imagename = $request->file('image');
            $fileNameToStore= "setting_" .time().'.jpg';
            $imagename->move(public_path('setting/'), $fileNameToStore);
            $info->image='/setting/'.$fileNameToStore;
        }
        $info->save();
        return back()->with('success','تم حفظ  بنجاح');
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
