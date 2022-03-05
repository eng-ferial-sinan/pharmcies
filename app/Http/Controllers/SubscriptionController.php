<?php

namespace App\Http\Controllers;

use App\Models\Subscription;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
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
        $subscription = Subscription::all();
        return view('admin.subscription.index')->with('Subscriptions',$subscription);
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscription =  Subscription::find($id);
        $subscription->delete();
    return back()-> with('success','تم حذف  '.$subscription->name.'');
    }
}
