<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Artisan;
use Illuminate\Support\Facades\Notification;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('customer.account');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function orders()
    {
        $orders=Order::where('user_id',auth()->user()->id)
        ->paginate(10);
        return view('customer.orders',compact('orders'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Order $order)
    {
        $order = Order::find($order->id);
        return view('customer.order',compact('order'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function register()
    {
        return view('pages.register');
    }
  
/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkout(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'address_id' => 'required',
        ]);

        if(!auth()->user())
        {
            return redirect()->route('index');
        }

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }
        if(is_null($cart))
        {
            return redirect()->route('index');
        }
        
        $setting=Setting::first();
        $address=Address::find($request['address_id']);
        
        $distance=(6371 * acos(cos($this->radians( $address->lat ))
                    * cos($this->radians($setting->lat)) * cos($this->radians($setting->lng) - $this->radians($address->lng))
                    + sin($this->radians($address->lat)) * sin($this->radians($setting->lat))));
        $amont=(int)$distance*100;

        $order=new Order;
        $order->status_id=1;
        $order->user_id=auth()->user()->id;
        $order->address=$address->address;
        $order->lat=$address->lat;
        $order->lng=$address->lng;
        $order->delivery_price=$amont;
        $order->sub_total=$cart->totalPrice;
        $order->total=$order->delivery_price+$order->sub_total;
        $order->save();

        foreach($cart->items as $item)
        {
            $product=Product::find($item['id']);
            $order_product=new OrderProduct;
            $order_product->order_id=$order->id;
            $order_product->product_id=$product->id;
            $order_product->product=json_encode($product);
            $order_product->count=$item['qty'];
            $order_product->price=$product->price;
            $order_product->sum=($item['qty']*$product->price);
            $order_product->save();
        }

        $users=User::role('مدير')->get();
        Notification::send($users, new OrderNotification($order));       
        session()->forget('cart');
        return redirect()->route('orders')->with('success', 'الطلب تم انشاءه');
     }
     public function payment(Request $request ,$id)
    {
        // dd($request);

        if(!auth()->user())
        {
            return redirect()->route('index');
        }

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }
        if(is_null($cart))
        {
            return redirect()->route('index');
        }
        
        $setting=Setting::first();
        $address=Address::find($id);
        
        $distance=(6371 * acos(cos($this->radians( $address->lat ))
                    * cos($this->radians($setting->lat)) * cos($this->radians($setting->lng) - $this->radians($address->lng))
                    + sin($this->radians($address->lat)) * sin($this->radians($setting->lat))));
        $amont=(int)$distance*100;

        

        $order=new Order;
        $order->status_id=1;
        $order->user_id=auth()->user()->id;
        $order->address=$address->address;
        $order->lat=$address->lat;
        $order->lng=$address->lng;
        $order->delivery_price=$amont;
        $order->sub_total=$cart->totalPrice;
        $order->method_id=2;
        $order->total=$order->delivery_price+$order->sub_total;
        $result=null;
        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
        $data=$request->input('payload');
        if($data['nonce'] != null){
            $nonceFromTheClient = $data['nonce'];
           $return_data = $gateway->transaction()->sale([
                'amount' => $order->total,
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
           return response()->json(['success'=>false]);
            }
        }else{
            // $clientToken = $gateway->clientToken()->generate();
            return response()->json(['success'=>false]);
        }

        $order->save();
       
        $payment=new Payment;
        $payment->uuid=$result->id;
        $payment->data=json_encode($result);
        $payment->method_id=2;
        $payment->order_id=$order->id;
        $payment->save();

        foreach($cart->items as $item)
        {
            $product=Product::find($item['id']);
            $order_product=new OrderProduct;
            $order_product->order_id=$order->id;
            $order_product->product_id=$product->id;
            $order_product->product=json_encode($product);
            $order_product->count=$item['qty'];
            $order_product->price=$product->price;
            $order_product->sum=($item['qty']*$product->price);
            $order_product->save();
        }

        $users=User::role('مدير')->get();
        Notification::send($users, new OrderNotification($order));       
        session()->forget('cart');
        return response()->json(['success'=>true]);
    }

    public function calculate(Address $address)
    {
        $setting=Setting::first();

        $distance=(6371 * acos(cos($this->radians( $address->lat ))
                    * cos($this->radians($setting->lat)) * cos($this->radians($setting->lng) - $this->radians($address->lng))
                    + sin($this->radians($address->lat)) * sin($this->radians($setting->lat))));
        $amont=(int)$distance*100;
        return response()->json(['amont'=>$amont]);
    }
    public function radians($degrees)
    {
         return 0.0174532925 * $degrees;
    }


    public function update(Request $request)
    {
        $request->validate([
            'number' => 'required|array',
            'number.*' => 'required|numeric|min:1'
        ]);
        // dd($request->number);
        foreach($request->number as $key=> $value)
        {
            $cart = new Cart(session()->get('cart'));
            $cart->updateQty($key, $value);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.show')->with('success', 'تم تعديل السلة');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);

        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('success', ' تم الحذف من السلة');
    }

    public function addToCart(Product $product)
    {

        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $cart->add($product);
        //dd($cart);
        session()->put('cart', $cart);
        return redirect()->route('shop.all')->with('success', 'تم الاضافة الى السلة');
    }

    public function showCart()
    {
        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
            $token = $gateway->clientToken()->generate();



        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }

        if(auth()->user())
        {
            $addresses= Address::where('user_id',auth()->user()->id)->get();

        }else
        {
            $addresses=null;
        }

        return view('pages.cart', compact('cart','addresses','token'));
    }


}
