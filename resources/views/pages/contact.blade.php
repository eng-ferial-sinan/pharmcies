@extends('layouts.front_app')

@section('content')


<div id="all">
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 ">
            <!-- breadcrumb-->
            <nav aria-label="breadcrumb text-right" dir="rtl">
              <ol class="breadcrumb  ">
                <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                <li aria-current="page" class="breadcrumb-item active">اتصل بنا</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-12">
            <div id="contact" class="box text-lg-right">
              <h1>اتصل بنا</h1>
              <p class="lead">هل تشعر بالفضول حيال شيء ما؟ هل لديك مشكلة ما مع منتجاتنا؟</p>
              <p>لا تتردد في الاتصال بنا ، يعمل مركز خدمة العملاء لدينا على مدار الساعة طوال أيام الأسبوع.</p>
              <hr>
              <div class="row">
                <div class="col-md-4">
                  <h3><i class="fa fa-map-marker"></i>العنوان</h3>
                  <p>13/25 New Avenue<br>New Heaven<br>45Y 73J<br>England<br><strong>Great Britain</strong></p>
                </div>
                <!-- /.col-sm-4-->
                <div class="col-md-4">
                  <h3><i class="fa fa-phone"></i> مركز الاتصال</h3>
                  <p class="text-muted">هذا الرقم مجاني في حالة الاتصال من بريطانيا العظمى وإلا فإننا ننصحك باستخدام الشكل الإلكتروني للاتصال.</p>
                  <p><strong>+33 555 444 333</strong></p>
                </div>
                <!-- /.col-sm-4-->
                <div class="col-md-4">
                  <h3><i class="fa fa-envelope"></i> الدعم الإلكتروني</h3>
                  <p class="text-muted">لا تتردد في إرسال بريد إلكتروني إلينا أو استخدام نظام التذاكر الإلكتروني الخاص بنا.</p>
                  <ul>
                    <li><strong><a href="mailto:">info@fakeemail.com</a></strong></li>
                    <li><strong></strong> منصة دعم التذاكر الخاصة بنا</li>
                  </ul>
                </div>
                <!-- /.col-sm-4-->
              </div>
              <!-- /.row-->
              <hr>
              <div id="map"></div>
              <hr>
              <h2>فورم التواصل</h2>
              <form action="/contact" method="post">
                @csrf
                <div class="row text-lg-right">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="first_name">الاسم الاول</label>
                      <input name="first_name" id="first_name" type="text" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="last_name">الاسم الاخير</label>
                      <input name="last_name" id="last_name" type="text" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">الايميل</label>
                      <input name="email" id="email" type="text" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="subject">الموضوع</label>
                      <input name="subject" id="subject" type="text" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="message">الرسالة</label>
                      <textarea name="message" id="message" class="form-control" required></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o" ></i> ارسل الرسالة</button>
                  </div>
                </div>
                <!-- /.row-->
              </form>
            </div>
          </div>
          <!-- /.col-md-9-->
          
        </div>
      </div>
    </div>
  </div>
@endsection
