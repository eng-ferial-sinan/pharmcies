<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\usertoken;
use App\Models\Reservation;
use App\Models\User;
use App\Models\ReservationProduct;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Service;
use App\Notifications\ReservationNotification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reservation_date = $request->input('reservation_date')?$request->input('reservation_date'):date('Y-m-d');
        $response['status']=false;
        $token=$request->header('token');

        $user=User::where('token',$token)->first();
        if($user)
        {
         $reservation = Reservation::with(['salon','paymentMethod','payment'])->where('user_id',$user->id)->where('updated_at','>',$reservation_date)->get();
         $response['reservations']=$reservation;
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
                'salon_id' => 'required',
                'service_id' => 'required',
                'date' => 'required',
                'time' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['status'=>$status ,'data'=>array() ,'messages'=>$validator->errors()->all()],200);
            }
              $service =Service::find($request->service_id);
         
            $gateway = new \Braintree\Gateway([
                'environment' => env('BRAINTREE_ENV'),
                'merchantId' => env("BRAINTREE_MERCHANT_ID"),
                'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
                'privateKey' => env("BRAINTREE_PRIVATE_KEY")
            ]);
            
            if($request['nonce'] != null){
                $nonceFromTheClient = $request['nonce'];
               $return_data = $gateway->transaction()->sale([
                    'amount' => $service->price,
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
            $reservation=new Reservation;
            $reservation->user_id=$user->id;
            $reservation->method_id=isset($request->method_id)?$request->method_id:1;
            $reservation->salon_id=$request->salon_id;
            $reservation->date=$request->date;
            $reservation->time=$request->time;
            $reservation->service_id=$service->id;
            $reservation->price=$service->price;
            $reservation->save();

            if(isset($request->method_id))
            {
                   if($request->method_id==2)
                   {
                    $payment=new Payment;
                    $payment->uuid=$result->id;
                    $payment->data=json_encode($result);
                    $payment->method_id=2;
                    $payment->Reservation_id=$reservation->id;
                    $payment->save();
                   }
            }
        
            $reservation=Reservation::find($reservation->id);
            $users=User::role('مدير')->get();
            Notification::send($users, new ReservationNotification($reservation));       
            $response['data']['Reservation']=$reservation;
            $response['status']=true;
            $response['messages'][]="تم انشاء الحجز ";

       }else
       {
        $response['messages'][]="الحساب غير موجود";
       }
       return response()->json($response,200);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
       
   
    }
}
