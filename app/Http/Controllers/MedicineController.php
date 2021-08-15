<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\medicine;
use App\Models\category;

class MedicineController extends Controller
{
    //
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }
    public function index()
    {
       $categories2=category::pluck('name','id')->all();
        $medicine = medicine::all();
      return view('admin.medicine.index')->with('medicines',$medicine)
      ->with('categories2',$categories2);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicine =new medicine;
        return view('admin.medicine.form')->with('item',$medicine);
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
        ]);

        $medicine =new medicine;
        $medicine->name=$request->name;
        $medicine->traite=$request->traite;
        $medicine->demerites=$request->demerites;
        $medicine->relics=$request->relics;
        $medicine->price=$request->price;
        $medicine->production_date=$request->production_date;
        $medicine->expiry_date=$request->expiry_date;
        $medicine->category_id=$request->category_id;
        if($request->hasFile('image')){
            $imagename = $request->file('image');
            $fileNameToStore= "medicine_" .time().'.jpg';
            $imagename->move(public_path('medicines/'), $fileNameToStore);
            $medicine->image='/medicines/'.$fileNameToStore;            
             } 
        $medicine->save();
        
        return redirect()->back()
                        ->with('success','تم انشاء ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(medicine $medicine)
    {
        // $medicine =medicine::find($medicine->id);
        return view('admin.medicine.form')->with('item',$medicine);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $medicine = medicine::find($id);
        $medicine->name=$request->name;
        $medicine->traite=$request->traite;
        $medicine->demerites=$request->demerites;
        $medicine->relics=$request->relics;
        $medicine->price=$request->price;
        $medicine->production_date=$request->production_date;
        $medicine->expiry_date=$request->expiry_date;
        $medicine->category_id=$request->category_id;
        if($request->hasFile('image')){
            $imagename = $request->file('image');
            $fileNameToStore= "medicine_" .time().'.jpg';
            $imagename->move(public_path('medicines/'), $fileNameToStore);
            $medicine->image='/medicines/'.$fileNameToStore;            
             } 
        $medicine->save();
        

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
        $medicine =  medicine::find($id);
        $medicine->delete();
    return back()-> with('success','تم حذف  '.$medicine->name.'');
    }
}
