<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    
    public function __construct(Request $request)
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
        $promotion = Promotion::all();
      return view('admin.promotion.index')->with('promotions',$promotion);
  
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
        $this->validate($request, [
            'image' => 'required',
            'sort' => 'required',
            'salon_id' => 'required',
        ]);
        $promotion =new Promotion;
        $promotion->sort=$request->sort;
        $promotion->salon_id=$request->salon_id;

        if ($request->hasFile('image')) {
            $imagename = $request->file('image');
            $fileNameToStore= "Promotion_" .time().'.jpg';
            $imagename->move(public_path('promotion/'), $fileNameToStore);
            $promotion->image='/promotion/'.$fileNameToStore;
        }
        $promotion->save();
        return redirect()->back()
                        ->with('success','تم انشاء ');
  

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
        $this->validate($request, [
            'sort' => 'required',
            'salon_id' => 'required',
        ]);
        $promotion = Promotion::find($id);
        $promotion->sort=$request->sort;
        $promotion->salon_id=$request->salon_id;
        if ($request->hasFile('image')) {
            $imagename = $request->file('image');
            $fileNameToStore= "Promotion_" .time().'.jpg';
            $imagename->move(public_path('promotion/'), $fileNameToStore);
            $promotion->image='/promotion/'.$fileNameToStore;
        }
        $promotion->save();
        return  back()-> with('success','تم حفظ التعديلات ');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $promotion =  Promotion::find($id);
        $promotion->delete();
    return back()-> with('success','تم حذف  '.$promotion->name.'');
 
    }
}
