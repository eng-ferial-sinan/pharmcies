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
        $order = Order::all();
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

    public function setStatus(Request $request)
    {
        $order =Order::find($request->order_id);
        $order->status_id = $request->status_id ;
        $order->save() ;
        $order =$order->fresh();
        return $order->status->name;
    }
    public function setUser(Request $request)
    {
        $order =order::find($request->order_id);
        $order->driver_id = $request->user_id ;
        $order->status_id = 3 ;
        $order->save() ;
        $order =$order->fresh();
        $data['user']=$order->driver->name;
        $data['status']=$order->status->name;
        return $data;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($order)
    {
        $order = Order::find($order);
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
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order =  Order::find($id);
        $order->delete();
    return back()-> with('success','تم حذف  '.$order->name.'');
    }
}
