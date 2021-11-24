<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\usertoken;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderProduct;
use App\Models\Product;
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

        $user=User::where('token',$token)->first();
        if($user)
        {
         $order = Order::with('orderProduct')->where('user_id',$user->id)->where('updated_at','>',$order_date)->get();
         $response['orders']=$order;
         $response['status']=true;
         $response['messages'][]="الطلبيات";

       }else
       {
        $response['messages'][]="الحساب غير موجود";

       }
       return response()->json($response,200);
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
        $user=User::where('token',$token)->first();
        if($user)
        {
            $validator = Validator::make($request->all(), [
                'products' => 'required|string',
                'address' => 'required|string',
                'lat' => 'required',
                'lng' => 'required',
                'delivery_price' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['status'=>$status ,'data'=>array() ,'messages'=>$validator->errors()->all()],200);
            }

            $order=new Order;
            $order->status_id=1;
            $order->user_id=$user->id;
            $order->address=$request->address;
            $order->lat=$request->lat;
            $order->lng=$request->lng;
            $order->delivery_price=$request->delivery_price;
            $order->save();
            $total_sum=0;

           $products=json_decode($request->products,true);

            foreach ($products as $p) 
            {

                    $product=Product::find($p['id']);
                    if($product)
                    {
                    $order_product=new OrderProduct();
                    $order_product->order_id=$order->id;
                    $order_product->product_id=$p['id'];
                    $order_product->product=json_encode($product);
                    $order_product->count=$p['count'];
                    $order_product->price=$product->price;
                    $order_product->sum=($p['count']*$product->price);
                    $order_product->save();
                    $total_sum+=($p['count']*$product->price);
                     }
                      else
                    {
                        $response['messages'][]="المنتج غير موجود";
                          $order->delete();
                        return response()->json($response,200);

                    }
            }
        
            $order->sub_total=$total_sum;
            $order->total=$order->delivery_price+$total_sum;
            $order->save();
            $order=order::with(['orderProduct','status'])->find($order->id);
            $users=User::role('مدير')->get();
            Notification::send($users, new OrderNotification($order));       
            $response['data']['order']=$order;
            $response['status']=true;
            $response['messages'][]="تم انشاء الطلبية ";

       }else
       {
        $response['messages'][]="الحساب غير موجود";
       }
       return response()->json($response,200);
   
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
