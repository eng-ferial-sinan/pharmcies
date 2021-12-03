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
                <li aria-current="page" class="breadcrumb-item active">حسابي</li>
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
          <div class="col-lg-9 text-right" dir="rtl">
            <div class="box">
              <h1>حسابي</h1>
              <p class="lead">قم بتغيير بياناتك الشخصية أو كلمة مرورك هنا.</p>
              <h3>تغير كلمة السر</h3>
              <form action="/customer/update" method="POST">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="password">كلمة السر الجديدة</label>
                      <input name="password" id="password" type="password" required class="form-control">
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="password-confirm">تاكيد كلمة السر</label>
                      <input name="password_confirmation" id="password-confirm" type="password" required class="form-control">
                    </div>
                  </div>
                </div>
                <!-- /.row-->
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> حفظ كلمة السر الجديدة</button>
                </div>
              </form>
              <h3 class="mt-5">البيانات الشخصية</h3>
              <form action="/customer/update" method="POST">
                @csrf
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="name">الاسم</label>
                      <input name="name" id="name" type="text" value="{{auth()->user()->name}}" class="form-control" >
                    </div>
                  </div>
                </div>
                <!-- /.row-->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="phone">التلفون</label>
                      <input name="phone" id="phone" type="text" value="{{auth()->user()->phone}}" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">البريد الالكتروني</label>
                      <input name="email" id="email" type="text"  value="{{auth()->user()->email}}" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>حفظ التعديلات</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection