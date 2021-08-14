<?php

namespace App\Http\Controllers;
use App\Models\order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $order = order::all();
        return view('admin.order.index')->with('orders',$order);    
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
            'total_pice' => 'required',
        ]);

        $order =new order;
        $order->total_pice=$request->total_pice;
        $order->save();
        return redirect()->back()
                        ->with('success','تم انشاء ');  
   
    }
    public function setStatus(Request $request)
    {
        dd($request->input('order_id'));
        $order =order::find($request->input('order_id'));
        $order->status = $request->input('status_id') ;
        $order->save() ;   
        $order =$order->fresh();     
        return $order->status->name;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show( $order)
    {
        $order = order::find($order);
        return view('admin.order.show')->with('order',$order);    
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $this->validate($request, [
            'total_pice' => 'required',
        ]);

        $order = order::find($id);
        $order->total_pice=$request->total_pice;
        $order->save();

        return  back()-> with('success','تم حفظ التعديلات '); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $order =  order::find($id);
        $order->delete();
    return back()-> with('success','تم حذف  '.$order->name.''); 
   
    }
}
