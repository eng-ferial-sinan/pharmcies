<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Salon;

class ServiceController extends Controller
{
    //
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }
    public function index()
    {
       $categories=Salon::pluck('name','id')->all();
        $service = Service::all();
      return view('admin.service.index')->with('services',$service)
      ->with('categories',$categories);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service =new Service;
        return view('admin.service.form')->with('item',$service);
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
            'salon_id' => 'required',
            'name' => 'required',
        ]);

        $service =new Service;
        $service->name=$request->name;
        $service->desc=$request->desc;
        $service->price=$request->price;
        $service->sort=$request->sort;
        $service->salon_id=$request->salon_id;
        if ($request->hasFile('image')) {
            $imagename = $request->file('image');
            $fileNameToStore= "Service_" .time().'.jpg';
            $imagename->move(public_path('Services/'), $fileNameToStore);
            $service->image='/Services/'.$fileNameToStore;
        }
        $service->save();
        
        return redirect()->back()
                        ->with('success','تم انشاء ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $service =Service::find($service->id);
        return view('admin.service.form')->with('item',$service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'salon_id' => 'required',
        ]);

        $service = Service::find($id);
        $service->name=$request->name;
        $service->desc=$request->desc;
        $service->price=$request->price;
        $service->sort=$request->sort;
        $service->salon_id=$request->salon_id;
        if ($request->hasFile('image')) {
            $imagename = $request->file('image');
            $fileNameToStore= "Service_" .time().'.jpg';
            $imagename->move(public_path('Services/'), $fileNameToStore);
            $service->image='/Services/'.$fileNameToStore;
        }
        $service->save();
        

        return  back()-> with('success','تم حفظ التعديلات ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\collage  $collage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service =  Service::find($id);
        $service->delete();
    return back()-> with('success','تم حذف  '.$service->name.'');
    }
}
