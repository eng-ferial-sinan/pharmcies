<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use Illuminate\Http\Request;
use App\Models\usertoken;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Plan;
use App\Notifications\OrderNotification;
use App\Notifications\SubscriptionNotification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subscription_date = $request->input('subscription_date')?$request->input('subscription_date'):date('Y-m-d');
        $response['status']=false;
         $subscription = Subscription::with(['plan','payment'])->where('user_id',auth()->user()->id)->where('updated_at','>',$subscription_date)->get();
         $response['subscriptions']=$subscription;
         $response['status']=true;
         $response['messages'][]="الاشتركات";
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
    public function store(SubscriptionRequest $request)
    {
        $status=false;
        $response['data']=array();
        $response['status']=false;
        $request = $request->all();

        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
            
            $plan=Plan::find($request['plan_id']);
            if(isset($request['nonce']))
            {
                $nonceFromTheClient = $request['nonce'];
                $return_data = $gateway->transaction()->sale([
                    'amount' => $request['type']?$plan->monthly_subscription:$plan->yearly_subscription,
                    'paymentMethodNonce' => $nonceFromTheClient,
                    'options' => [
                        'submitForSettlement' => True
                    ]
                ]);
                if( $return_data->success)
                {
                    $result= $return_data->transaction;
                }else
                {
                    $response['status']=false;
                    $response['messages'][]=$return_data->message;
                    return response()->json($response);
                }
            }
            
                $payment=new Payment;
                $payment->uuid=$result->id;
                if($request['method_id']==2)
                {
                 $payment->data=json_encode($result);
                }
                $payment->method_id=$request['method_id'];
                $payment->save();
            

            $subscription=new Subscription;
            $subscription->status=1;
            $subscription->user_id=auth()->user()->id;
            $subscription->plan_id=$request['plan_id'];
            $subscription->payment_id=$payment->id;
            $subscription->price=$request['type']?$plan->monthly_subscription:$plan->yearly_subscription;
            $subscription->save();

        
            $subscription=Subscription::with(['plan','payment'])->find($subscription->id);
            $users=User::role('مدير')->get();
            Notification::send($users, new SubscriptionNotification($subscription));       
            $response['data']['subscription']=$subscription;
            $response['status']=true;
            $response['messages'][]="تم انشاء اشتراك جديد ";

       return response()->json($response,200);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function token()
    {
        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
        $token = $gateway->clientToken()->generate();

       return response()->json(['token'=>$token],200);
    }

    public function method()
    {
       $method= PaymentMethod::all();
       return response()->json(['method'=>$method],200);
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
