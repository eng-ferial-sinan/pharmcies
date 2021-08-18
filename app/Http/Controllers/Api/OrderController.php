<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\usertoken;
use App\Models\order;
use App\Models\detail;
use App\Models\User;
use App\Models\medicine;
use App\Models\Pharmacy;
use App\Notifications\OrderNotification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order_date = $request->input('order_date')?$request->input('order_date'):date('Y-m-d');
        $response['status']=false;
        $token=$request->header('token');

        $usertoken=usertoken::where('token',$token)->first();
        if($usertoken)
        {

         $user_id=$usertoken->user_id;
         $user=User::find($user_id);
         if($user->user_type !='صيدلية')
         {
         $order = order::with('details')->where('user_id',$user->id)->where('updated_at','>',$order_date)->get();
         }else
         {
            if($user->pharmacy)
         $order = order::with('details')->where('pharmacy_id',$user->pharmacy->id)->where('updated_at','>',$order_date)->get();
         }
         $response['user']=$user;
         $response['orders']=$order;
         $response['status']=true;
         $response['messages'][]="الطلبيات";

       }else
       {
        $response['messages'][]="الحساب غير موجود";

       }
       return response()->json($response);
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
        $status=false;
        $response['data']=array();
        $response['status']=false;
        $token=$request->header('token');
        $usertoken=usertoken::where('token',$token)->first();
        if($usertoken)
        {
            $validator = Validator::make($request->all(), [
                'detalis' => 'required|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['status'=>$status ,'data'=>array() ,'messages'=>$validator->errors()->all()],200);
            }
         $user_id=$usertoken->user_id;
         $user=User::find($user_id);
         if($user->user_type !='صيدلية')
         {
            return response()->json(['status'=>$status ,'data'=>array() ,'messages'=>['لايمكنك الطلب']],200);
         }
        if($user->pharmacy)
        {
            $order=new order;
            $order->status_id=1;
            $order->pharmacy_id=$user->pharmacy->id;
            $order->save();
            $total_sum=0;

        $detalis=json_decode($request->detalis,true);

        foreach ($detalis as $datat) 
                {

                    $medicine=medicine::find($datat['id']);
                    if($medicine)
                    {
                    $detail=new detail;
                    $detail->order_id=$order->id;
                    $detail->medicine_id=$datat['id'];
                    $detail->medicine=json_encode($medicine);
                    $detail->count=$datat['count'];
                    $detail->price=$medicine->price;
                    $detail->sum=($datat['count']*$medicine->price);
                    $detail->save();
                    $total_sum+=($datat['count']*$medicine->price);
                     }
                      else
                    {
                        $response['messages'][]="المنتج غير موجود";
                          $order->delete();
                        return response()->json($response);

                    }
                }
        
            $order->total_pice=$total_sum;
            $order->save();
            $order=order::with(['details','status'])->find($order->id);
            $pharmacy=$user->pharmacy;
            $pharmacy->order_count=$pharmacy->order_count+1;
            $pharmacy->save();
            $users=User::where('user_type','مدير')->get();
            Notification::send($users, new OrderNotification($order,$user,$pharmacy,$order->status));       
            $response['data']['user']=$user;
            $response['data']['order']=$order;
            $response['status']=true;
            $response['messages'][]="تم انشاء الطلبية ";
            
        }else
        {
            $response['messages'][]="الصيدلية غير موجود";
 
        }

       }else
       {
        $response['messages'][]="الحساب غير موجود";
       }
       return response()->json($response);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
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
        $response['data']=array();
        $response['status']=false;
        $token=$request->header('token');
        $usertoken=usertoken::where('token',$token)->first();
        if(!$usertoken)
        {
            $response['messages']=["يجب تسجيل الدخول"];
            return response()->json($response,200);
        }
        $validator = Validator::make($request->all(), [
            'status' => 'required|string',            
        ]);

        if ($validator->fails()) {
             $response['messages']=$validator->errors()->all();
             return response()->json($response,200);
            }

        $order = order::find($id);
        if(!is_null($order))
        {
        $order->status_id=$request->status;
        $order->save();
        $order->refresh();
        if(isset($request->lat )&& isset($request->lng))
        {
            $user=$usertoken->user;
            $user->lat=$request->lat;
            $user->lng=$request->lng;
            $user->save();
        }
        $users=User::where('user_type','مدير')->get();
        $order = order::with(['user','pharmacy','status'])->find($id);
        // dd($order->status);
        foreach($users as $user)
        {
                try {
                    Notification::send($user, new OrderNotification($order,$order->pharmacy->user,$order->pharmacy,$order->status));
                    } catch (\Exception $error) {

                    }
        }
        $response['data']=$order;
        $response['status']=true;
        $response['messages'][]="تم تعير الحالة";
        }else
        {
        $response['messages'][]="الحساب غير موجود";

        }
      return response()->json($response ,200);
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
       
   
    }
}
