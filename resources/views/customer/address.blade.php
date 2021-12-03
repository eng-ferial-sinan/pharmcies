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
          <div class="box ">
            <div class=" text-right d-flex justify-content-between flex-column flex-lg-row">
              <div class="left">
                <h1>عناويني</h1>
              </div>
              <div class="right">
                <a href="/address/create" class="btn btn-primary btn-sm">اضافة عناون</a>
              </div>
            </div>
           
             <hr>
            <div class="table-responsive">
              <table dir="rtl" class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th colspan="3">address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($addresses as $address)
                  <tr>
                    <th># {{$address->id}}</th>
                    <td colspan="3">{{$address->address}}</td>
                    <td>
                      <a href="/address/{{$address->id}}/edit" class="btn btn-primary btn-sm">تعديل</a>
                      {!!Form::open(['action' => ['App\Http\Controllers\AddressController@destroy','address'=>$address->id],'method'=>'POST', 'class'=>'pull-left','onsubmit' => 'return ConfirmDelete()'])!!}
                      {{Form::hidden('_method','DELETE')}}
                      {{Form::submit('الحذف',['class'=>'btn btn-danger btn-sm'])}}
                      {!!Form::close()!!}
                    </td>
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection