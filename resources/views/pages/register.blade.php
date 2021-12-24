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
                <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                <li aria-current="page" class="breadcrumb-item active">انشاء حساب جديد</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-6 text-right" dir="rtl">
            <div class="box">
              <h1>حساب جديد</h1>
              <p class="lead">لم تسجل حتى الآن؟</p>
              <p>مع التسجيل معنا عالم جديد من الموضة ، وخصومات رائعة وأكثر من ذلك بكثير يفتح لك! العملية برمتها لن تستغرق أكثر من دقيقة!</p>
              <p class="text-muted">إذا كان لديك أي أسئلة ، فلا تتردد في ذلك<a href="/contact">تواصل معنا</a>,يعمل مركز خدمة العملاء لدينا من أجلك 24/7.</p>
              <hr>
              <form action="/customer/register" method="post">
                 @csrf
                <div class="form-group">
                  <label for="name">الاسم</label>
                  <input name="name" id="name" type="text"  value="{{ old('name') }}" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="email">البريد الالكتروني</label>
                  <input name="email" id="email" type="text" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="password">كلمة السر</label>
                  <input name="password" id="password" type="password" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="password">تاكيد كلمة السر</label>
                  <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="phone">رقم التلفون</label>
                  <input name="phone" id="phone" type="text" value="{{ old('phone') }}" class="form-control" required>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> تسجيل</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 text-right" dir="rtl">
            <div class="box">
              <h1>تسجيل الدخول</h1>
              <p class="lead">هل انت عميل لدينا ?</p>
              <hr>
              <form action="/customer/login" method="post">
                @csrf                
                <div class="form-group">
                  <label for="email">البريد الالكتروني</label>
                  <input name="email" id="email" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="password">كلمة السر</label>
                  <input name="password" id="password" type="password" class="form-control" required>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i>تسجيل الدخول</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
