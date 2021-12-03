<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    //
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $address = Address::where('user_id',auth()->user()->id)->get();
      return view('customer.address')->with('addresses',$address);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $address =new Address;
        return view('customer.form')->with('item',$address);
  
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
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);
        $address =new Address;
        $address->address=$request->address;
        $address->lat=$request->lat;
        $address->lng=$request->lng;
        $address->user_id=auth()->user()->id;
        $address->save();
        return redirect()->back()
                        ->with('success','تم انشاء ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Address $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        return view('customer.form')->with('item',$address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $this->validate($request, [
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);
        $address = Address::find($address->id);
        $address->address=$request->address;
        $address->lat=$request->lat;
        $address->lng=$request->lng;
        $address->save();

        return  back()-> with('success','تم حفظ التعديلات ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\collage  $collage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();
    return back()-> with('success','تم حذف  '.$address->address.'');
    }
}
