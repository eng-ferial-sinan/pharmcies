@extends('layouts.front_app')

@section('content')

<div id="all">
  <div id="content">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <!-- breadcrumb-->
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
              <li aria-current="page" class="breadcrumb-item"><a href="/customer/orders">طلباتي</a></li>
              <li aria-current="page" class="breadcrumb-item active">الطلب # 1735</li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-3">
          <!--
          *** CUSTOMER MENU ***
          _________________________________________________________
          -->
          <div class="card sidebar-menu text-right">
            <div class="card-header">
              <h3 class="h4 card-title">قسم الزبون</h3>
            </div>
            <div class="card-body ">
              <ul dir="rtl" class="nav nav-pills flex-column">
                <a href="/customer/orders" class="nav-link {{ (Request::is('/customer/orders') ? 'active' : '')}}"><i class="fa fa-list"></i> طلباتي</a>
                <a href="/customer/account" class="nav-link {{{ (Request::is('/customer/account') ? 'active' : '')}}}"><i class="fa fa-user"></i> بيانات الحساب </a>
                <a href="/address" class="nav-link {{{ (Request::is('/address') ? 'active' : '')}}}"><i class="fa fa-user"></i> العناوين  </a>
                <a href="/customer/logout" class="nav-link"><i class="fa fa-sign-out"></i> تسجيل الخروج</a></ul>
              </div>
          </div>
          <!-- /.col-lg-3-->
          <!-- *** CUSTOMER MENU END ***-->
        </div>
        <div id="customer-order" class="col-lg-9 text-right" dir="rtl">
          <div class="box">
            <h1>الطلب #{{$order->id}}</h1>
            <p class="lead">الطلب  #{{$order->id}} تم وضعه على 
              <strong>{{$order->created_at->format('Y-m-d')}}</strong>
               و حاليا 
              <strong>
                
                {{$order->status?$order->status->name:'-'}}
              </strong>
            </p>
            <p class="text-muted">إذا كان لديك أي أسئلة ، فلا تتردد في ذلك<a href="/contact">تواصل معنا</a>,يعمل مركز خدمة العملاء لدينا من أجلك 24/7.</p>
            <hr>
            <div class="table-responsive mb-4">
              <table class="table">
                <thead>
                  <tr>
                    <th colspan="3">منتج</th>
                    <th>الكمية</th>
                    <th>سعر الوحدة</th>
                    <th>الاجمالي</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderProduct as $item)
                  <tr>  
                    <td><a href="#"><img src="{{$item->products->image}}" alt="{{$item->products->name}}"></a></td>
                    <td colspan="2"><a href="#">{{$item->products->name}}</a></td>
                    <td>{{$item->count}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->sum}}</td>
                  </tr>
                  @endforeach
                  
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="5" class="text-right">اجمالي المنتجات</th>
                    <th>{{$order->sub_total}}</th>
                  </tr>
                  <tr>
                    <th colspan="5" class="text-right">سعر التوصيل</th>
                    <th>{{$order->delivery_price}}</th>
                  </tr>
                  <tr>
                    <th colspan="5" class="text-right">الاجمالي الكلي</th>
                    <th>{{$order->total}}</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.table-responsive-->
            <div class="row addresses">
              <div class="col-lg-10">
                <h2>عنوان التوصيل</h2>
                <p>{{$order->address}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection