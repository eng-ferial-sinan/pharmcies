@extends('layouts.front_app')

@section('content')

@php 

$info= sitinfo();
@endphp

<div id="all">
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 ">
            <!-- breadcrumb-->
            <nav aria-label="breadcrumb text-right" dir="rtl">
              <ol class="breadcrumb  ">
                <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
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
                  <p>{{$info->address}}</p>
                </div>
                <!-- /.col-sm-4-->
                <div class="col-md-4">
                  <h3><i class="fa fa-phone"></i> مركز الاتصال</h3>
                  <p class="text-muted">هذا الرقم مجاني في حالة الاتصال من بريطانيا العظمى وإلا فإننا ننصحك باستخدام الشكل الإلكتروني للاتصال.</p>
                  <p><strong>{{$info->phone}}</strong></p>
                </div>
                <!-- /.col-sm-4-->
                <div class="col-md-4">
                  <h3><i class="fa fa-envelope"></i> الدعم الإلكتروني</h3>
                  <p class="text-muted">لا تتردد في إرسال بريد إلكتروني إلينا أو استخدام نظام التذاكر الإلكتروني الخاص بنا.</p>
                  <ul>
                    <li><strong><a href="mailto:">{{$info->email}}</a></strong></li>
                    <li><strong></strong> منصة دعم التذاكر الخاصة بنا</li>
                  </ul>
                </div>
                <!-- /.col-sm-4-->
              </div>
              <!-- /.row-->
              <hr>
              <input type="hidden" name='address' value="{{$info->address}}"  id='address' >

              <input hidden type="text" name='lat' value="{{$info->lat}}" id='map_1'>
              <input hidden type="text" name='lang' value="{{$info->lng}}" id='map_2'>
  
              {{-- <div id="map"></div> --}}
              <div id="cat_mapxx" style="height:250px;width:100%"></div>

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

@section('script')
<script type="text/javascript">
  var icon = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/blue.png", new google.maps.Size(32, 32), new google.maps.Point(0, 0), new google.maps.Point(16, 32));
  var icon1 = new google.maps.MarkerImage("http://maps.google.com/mapfiles/ms/micons/yellow.png", new google.maps.Size(32, 32), new google.maps.Point(0, 0), new google.maps.Point(16, 32));
  var center = null;
  var map = null;
  var currentPopup;
  var bounds = new google.maps.LatLngBounds();

  function addMarker(lat, lng, info,icon) {
    var pt = new google.maps.LatLng(lat, lng);
    map.setCenter(pt);
    map.setZoom(4);
    var marker = new google.maps.Marker({
      position: pt,
      icon: icon,
      map: map
    });
    var popup = new google.maps.InfoWindow({
      content: info,
      maxWidth: 300
    });
    google.maps.event.addListener(marker, "click", function() {
      if (currentPopup != null) {
        currentPopup.close();
        currentPopup = null;
      }
      popup.open(map, marker);
      currentPopup = popup;
    });
    google.maps.event.addListener(popup, "closeclick", function() {
      map.panTo(center);
      currentPopup = null;
    });
  }
  
  function myMap() {
    map = new google.maps.Map(document.getElementById("cat_mapxx"), {
      center: new google.maps.LatLng(0, 0),
      zoom: 0.5,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false,
      mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
      },
      navigationControl: true,
      navigationControlOptions: {
        style: google.maps.NavigationControlStyle.SMALL
      }
    });
  
  addMarker(document.getElementById("map_1").value ? document.getElementById("map_1").value : 15.344,document.getElementById("map_2").value ? document.getElementById("map_2").value : 44.185, document.getElementById("address").value,icon);

  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjCQ-zcT_xB12XkBftRS5tIVRyd8AJSdk&callback=myMap"></script>
@endsection