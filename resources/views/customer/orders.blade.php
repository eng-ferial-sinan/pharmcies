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
              <li aria-current="page" class="breadcrumb-item active">طلباتي</li>
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
        <div id="customer-orders" class="col-lg-9">
          <div class="box text-right">
            <h1>طلباتي</h1>
            <p class="lead">طلباتك في مكان واحد.</p>
            <p class="text-muted">إذا كان لديك أي أسئلة ، فلا تتردد في ذلك<a href="/contact">تواصل معنا</a>,يعمل مركز خدمة العملاء لدينا من أجلك 24/7.</p>
            <hr>
            <div class="table-responsive">
              <table dir="rtl" class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>التاريخ</th>
                    <th>الاجمالي</th>
                    <th>الحالة</th>
                    <th>عرض</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $order)
                  <tr>
                    <th># {{$order->id}}</th>
                    <td>{{$order->created_at->format('Y-m-d')}}</td>
                    <td>{{$order->total}}</td>
                    <td>
                      @if ($order->status_id==1)
                      <span class="badge badge-info">
                      @elseif ($order->status_id==2)
                      <span class="badge badge-info">
                      @elseif ($order->status_id==3)
                      <span class="badge badge-success">
                      @elseif ($order->status_id==4)
                      <span class="badge badge-warning">
                      @else
                      <span class="badge badge-danger">  
                      @endif
                      {{$order->status?$order->status->name:'-'}}
                    </span>
                    </td>
                    <td><a href="/customer/orders/{{$order->id}}" class="btn btn-primary btn-sm">عرض</a></td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <div class="pages">
                    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                        {{ $orders->links() }}
                    </nav>
                </div>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection