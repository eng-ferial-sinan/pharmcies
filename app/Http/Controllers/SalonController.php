<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salon;

class SalonController extends Controller
{
    //
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $salon = Salon::all();
      return view('admin.salon.index')->with('salons',$salon);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'sort' => 'required',
        ]);

        $salon =new Salon;
        $salon->name=$request->name;
        $salon->sort=$request->sort;
        $salon->address=isset($request->address)?$request->address:'';
        $salon->city=isset($request->city)?$request->city:'';
        $salon->lat=isset($request->map_1)?$request->map_1:'';
        $salon->lng=isset($request->map_2)?$request->map_2:'';


        if ($request->hasFile('image')) {
            $imagename = $request->file('image');
            $fileNameToStore= "salon_" .time().'.jpg';
            $imagename->move(public_path('categories/'), $fileNameToStore);
            $salon->image='/categories/'.$fileNameToStore;
        }
        $salon->save();
        return redirect()->back()
                        ->with('success','تم انشاء ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salon  $Salon
     * @return \Illuminate\Http\Response
     */
    public function show(Salon $Salon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Salon  $Salon
     * @return \Illuminate\Http\Response
     */
    public function edit(Salon $salon)
    {
      return view('admin.salon.form')->with('item',$salon);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salon  $Salon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'sort' => 'required',
        ]);

        $salon = Salon::find($id);
        $salon->name=$request->name;
        $salon->sort=$request->sort;
        $salon->address=isset($request->address)?$request->address:'';
        $salon->city=isset($request->city)?$request->city:'';
        $salon->lat=isset($request->map_1)?$request->map_1:'';
        $salon->lng=isset($request->map_2)?$request->map_2:'';


        if ($request->hasFile('image')) {
            $imagename = $request->file('image');
            $fileNameToStore= "salon_" .time().'.jpg';
            $imagename->move(public_path('categories/'), $fileNameToStore);
            $salon->image='/categories/'.$fileNameToStore;
        }
        $salon->save();

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
        $salon =  Salon::find($id);
        $salon->delete();
    return back()-> with('success','تم حذف  '.$salon->name.'');
    }
}
