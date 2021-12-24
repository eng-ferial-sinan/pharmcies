@extends('layouts.front_app')

@section('content')


<div id="all">
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <!-- breadcrumb-->
            <nav aria-label="breadcrumb text-right" dir="rtl">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                <li aria-current="page" class="breadcrumb-item active">سلة التسوق</li>
              </ol>
            </nav>
          </div>
          <div id="basket" class="col-lg-9">
            <div class="box">
                <h1>سلة التسوق</h1>
                <p class="text-muted">لديك حاليا 3 عناصر في عربة التسوق الخاصة بك.</p>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th colspan="2">المنتج</th>
                        <th>الكمية</th>
                        <th>السعر</th>
                        <th colspan="2">الاجمالي</th>
                      </tr>
                    </thead>
                    <tbody>
                      <form method="post" action="/cart/update" >
                        @csrf
                    @if($cart!==null)
                      @foreach ($cart->items as $item)
                      <tr>
                        <td><a href="#"><img src="{{$item['image']}}" alt="White Blouse Armani"></a></td>
                        <td><a href="#">{{$item['name']}}</a></td>
                        <td>
                          
                          <input name="number[{{$item['id']}}]" type="number" value="{{$item['qty']}}" class="form-control">
                        </td>
                        <td>{{$item['price']}}</td>
                        <td>{{$item['price'] * $item['qty']}}</td>
                        <td><a href="/cart/remove/{{$item['id']}}"><i class="fa fa-trash-o"></i></a></td>
                      </tr>
                      @endforeach
                    @else
                    <tr>
                      <td colspan="6" >لايوجد بيانات</td>
                    </tr>
                    @endif
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="5">الاجمالي</th>
                        <th colspan="2">{{$cart->totalPrice??0}}</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.table-responsive-->
                <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                  <div class="left">
                    <a href="/shop" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> استمر في التسوق</a></div>
                  <div class="right">
                    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-refresh"></i> تعديل السلة</button>
                  </form>
                    {{-- <a href="/checkout"  class="btn btn-primary">خروج <i class="fa fa-chevron-right"></i></a> --}}
                  </div>
                </div>
            </div>
            <!-- /.box-->
            {{--  --}}
          </div>
          <!-- /.col-lg-9-->
          <div class="col-lg-3">
            @auth
            <div id="order-summary" class="card">
              <div class="card-header">
                <h3 class="mt-4 mb-4">اتمام الطلبية</h3>
              </div>
              <div class="card-body">
                <p class="text-muted">يتم احتساب تكاليف الشحن والتكاليف الإضافية بناءً على القيم التي أدخلتها.</p>
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <form id="orderForm" method="get" action="/checkout">
                      <tr>
                        <td> عنوان التسليم</td>
                        <th>
                          <select name="address_id" id="address" class="form-control">
                            <option value="0" disabled >اختار عناون</option>
                          @foreach ($addresses as $address)
                              <option value="{{$address->id}}">{{$address->address}}</option>
                          @endforeach
                        </select>
                        <span>
                          <a href="/address/create">اضافة عناون</a>
                        </span>
                      </th>
                      </tr>
                      <tr>
                        <td>ترتيب المجموع الفرعي</td>
                        <th>{{$cart->totalPrice??0}}
                          <input hidden id="totalPrice" value="{{$cart->totalPrice??0}}" type="number" min=1 >
                        </th>
                      </tr>
                      <tr>
                        <td>التوصيل </td>
                        <th >
                          <div id="delivary">0</div>
                        </th>
                      </tr>
                      <tr class="total">
                        <td>الاجمالي</td>
                        <th>
                          <div id="total">{{$cart->totalPrice??0}}</div>
                          <input hidden id="paypal_amount" value="" type="number" min=1 >
                        </th>
                      </tr>
                      <tr class="total">
                        <td colspan="2" >طرق الدفع</td>
                      </tr>
                      @if (env('PAYPAL_CLIENT_ID') != NULL && env('PAYPAL_APP_SECRET') != NULL)
                      <tr>
                        <td> 
                          
											<input type="hidden" name="orderID" id="orderID">
											<input type="hidden" name="payerID" id="payerID">
											<input type="hidden" name="paymentID" id="paymentID">
											<input type="hidden" name="paymentToken" id="paymentToken">
											
                          {{--Paypal--}}
                          <div id="paypal">
                          </div>           
                        </td>
                        <td  >            
                          <button type="submit" class="btn btn-primary">  كاش
                            </button>
                        </td>
                      </tr>
                      @endif
                      
                    </form>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
            @endauth
            @guest
            <a href="#" data-toggle="modal" data-target="#login-modal" class="btn btn-primary">تسجيل الدخول</a>
            @endguest
            
          </div>
          <!-- /.col-md-3-->
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" id="paypal_route" value="{{route('paypal.payment')}}">
@endsection
@section('script')
@if (env('PAYPAL_CLIENT_ID') != NULL && env('PAYPAL_APP_SECRET') != NULL)
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
		<script>
            "use strict"
            paypal.Button.render({
                // Configure environment
                env: 'sandbox',
                client: {
                    sandbox: '{{env('PAYPAL_CLIENT_ID')}}',
                },
                // Customize button (optional)
                locale: 'en_US',
                style: {
                    size: 'responsive',
                    color: 'silver',
                    shape: 'rect',
                    label: 'paypal',
                    tagline: false,
                },

                // Enable Pay Now checkout flow (optional)
                commit: true,
                // Set up a payment
                payment: function (data, actions) {
                    return actions.payment.create({
                        transactions: [{
                            amount: {
                                total: $('#paypal_amount').val(),
                                currency: 'USD'
                            }
                        }]
                    });
                },
                // Execute the payment
                onAuthorize: function (data, actions) {
                    return actions.payment.execute().then(function () {
                        // Show a confirmation message to the buyer
                        console.log(data);
                        var payurl = $('#paypal_route').val();
                        /*append paypar action */
                        var b = document.getElementById("orderForm");
                        b.setAttribute('action', payurl);
                        /*append data in input form*/
                        $('#orderID').val(data.orderID);
                        $('#payerID').val(data.payerID);
                        $('#paymentID').val(data.paymentID);
                        $('#paymentToken').val(data.paymentToken);
                        $('#orderForm').submit();
                    });
                }
            }, '#paypal');
		</script>
    @endif

<script>
   $("#address").change(function(){
    // console.log();
     let id=$(this).val();
     let url = "{{  route('cart.calculate',['address' => ":id"]) }}";
       url = url.replace(":id", id);
            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    console.log(data['amont']);
                    $("#delivary").html(data['amont']);
                    var total=parseInt(data['amont'])+parseInt($('#totalPrice').val());
                    console.log(total);
                    $("#total").html(total);
                    $("#paypal_amount").val(total);
                    
                }
            });
        });
        $("#address").focus(function(){
            let id=$(this).val();
            let url = "{{  route('cart.calculate',['address' => ":id"]) }}";
              url = url.replace(":id", id);
                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(data) {
                            $("#delivary").html(data['amont']);
                            var total=parseInt(data['amont'])+parseInt($('#totalPrice').val());
                            $("#total").html(total);
                           $("#paypal_amount").val(total);
                            
                        }
                    });
        });
</script>

@endsection