<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingRequest;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    //
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $info = Setting::first();
        if ($info==null) {
            $info = new Setting;
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
    public function update(StoreSettingRequest $request)
    {
        // dd(1);
        $data=$request->validated();
        $data['lat']=$request->input('map_1');
        $data['lng']=$request->input('map_2');
        if ($request->hasFile('image')) {
            $imagename = $request->file('image');
            $fileNameToStore= "setting_" .time().'.jpg';
            $imagename->move(public_path('setting/'), $fileNameToStore);
            $data['image']='/setting/'.$fileNameToStore;
        }
        $info = Setting::first();
        $info->update($data);
        
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
