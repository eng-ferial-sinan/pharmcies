<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pharmacy;
class PharmacyController extends Controller
{
    //
     public function __construct(Request $request)
    {
        $this->middleware('auth');
       
    }
    public function index()
    {
        $pharmacy = pharmacy::all();
      return view('admin.pharmacy.index')->with('pharmacys',$pharmacy);
    
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pharmacy =new pharmacy;
        return view('admin.pharmacy.form')->with('item',$pharmacy);
  
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

        $pharmacy =new pharmacy;
        $pharmacy->name=$request->name;
        $pharmacy->user_id=$request->user_id;
        $pharmacy->address=$request->address;
        $pharmacy->save();
        return redirect()->back()
                        ->with('success','تم انشاء ');  
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function show(pharmacy $pharmacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function edit(pharmacy $pharmacy)
    {
        // $pharmacy =pharmacy::find($pharmacy->id);
        return view('admin.pharmacy.form')->with('item',$pharmacy);
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $pharmacy = pharmacy::find($id);
        $pharmacy->name=$request->name;
        $pharmacy->save();

        return  back()-> with('success','تم حفظ التعديلات '); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\collage  $collage
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $pharmacy =  pharmacy::find($id);
        $pharmacy->delete();
    return back()-> with('success','تم حذف  '.$pharmacy->name.''); 
   
    }
}
