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
            @if($cart!==null)
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
                      <tr>
                        @if(env('BRAINTREE_MERCHANT_ID') != "" &&  env('BRAINTREE_PUBLIC_KEY') != "")
                        <td>                           
                              
                          <a href="#" data-toggle="modal" data-target="#card">
                            <i class="fa fa-credit-card fa-2x"></i></a>
                          <div id="card" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                  <div id="dropin-container"></div>
                                  <p class="text-center">
                                    <a id="submit-button" class="btn btn-primary">دفع</a>
                                  </p>

                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                        @endif

                        <td>            
                          <button type="submit" class="btn btn-primary">  كاش
                            </button>
                        </td>
                      </tr>
                      
                    </form>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
            @endif
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
@endsection
@section('script')
@if(env('BRAINTREE_MERCHANT_ID') != "" &&  env('BRAINTREE_PUBLIC_KEY') != "")
<script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

<script>
  var button = document.querySelector('#submit-button');
  var id=$('#address').val();
  braintree.dropin.create({
    authorization: "{{$token}}",
    container: '#dropin-container'
  }, function (createErr, instance) {
    button.addEventListener('click', function () {

      instance.requestPaymentMethod(function (err, payload) {
        let url = "{{ route('paypal.payment',['id' => ":id"]) }}";
       url = url.replace(":id", id);
        $.get(url, {payload}, function (response) {
          if (response.success) {
            $('#card').modal('hide');
            window.location.href = "{{URL::to('/customer/orders')}}"
          } else {
          alert('Payment failed');
          window.location.href = "{{URL::to('/cart')}}"
          }
        }, 'json');
      });
    });
  });
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