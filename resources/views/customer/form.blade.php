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
              <h1>عناوين</h1>
              @if ($item->id == null)
              <h3>اضافة عنوان</h3>
              @else
              <h3>تغير بيانات العناون</h3>
              @endif
              <form method="post" action="@if ($item->id == null) {{ route('address.store') }} @else {{ route('address.update', ['address' => $item->id]) }} @endif" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if ($item->id != null)
                    {{ method_field('PUT') }}
                @endif   
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="password_old">العناون</label>
                      <input id="firstname" name="address" value="{{$item->address}}" type="text" class="form-control">
                      @error('address')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                   @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="lat">خط الطول</label>
                      <input id="lat" name="lat"  step="any" value="{{$item->lat}}" type="number" class="form-control">
                      @error('lat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="lng">خط العرض</label>
                      <input id="lng" name="lng" step="any" value="{{$item->lng}}" type="number" class="form-control">
                      @error('lng')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <hr>
                <h3>حدد الموقع على الخريظة</h3>

                <div class="row">
                  <div class="col-md-9">
                    <div id="cat_mapxx" style="height:250px;width:100%"></div>
                  </div>
                </div>
                <!-- /.row-->
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>حفظ</button>
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
@section('script')
   <script>
    var marker;        
    var map ,infoWindow ;
    var image = '1.png';
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }

    function myMap() {
        var mapCanvas = document.getElementById("cat_mapxx");
        //var myCenter=new google.maps.LatLng(15.344,44.185);
        var myCenter=new google.maps.LatLng(
                      (document.getElementById("lat").value ? document.getElementById("lat").value : 15.344),
                      (document.getElementById("lng").value ?document.getElementById("lng").value : 44.185));
               
        var mapOptions = {center: myCenter, zoom: 15};
            map = new google.maps.Map(mapCanvas, mapOptions);
          <?php if(!is_null($item->lat)) {?>
            marker = new google.maps.Marker({
                position: myCenter,
                map: map,
                icon: { url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"},
                title:"حدد الموقع"                
            });
        <?php }  ?> 
            var marker;     
        google.maps.event.addListener(map,'click', function(event) {
          placeMarker(map, event.latLng);
        });
        
       
           if (navigator.geolocation) {
             navigator.geolocation.getCurrentPosition(function(position) {
              var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
             };
             var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
               var marker = new google.maps.Marker({
                   position: pos,
                   map: map,
                   icon: iconBase + 'info-i_maps.png'
                        }); 
            map.setCenter(pos);
          
            map.setZoom(15);
            }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
            });
               } else {
              // Browser doesn't support Geolocation
              handleLocationError(false, infoWindow, map.getCenter());
             }
    }
      function placeMarker(map, location) {
        if (marker == undefined){
            marker = new google.maps.Marker({
                position: location,
                map: map,
                title:"حدد الموقع"                
            });
        }
        else{
            marker.setPosition(location);
        }
        document.getElementById("lat").value = location.lat().toFixed(15);
        document.getElementById("lng").value = location.lng().toFixed(15);
        map.setPosition(location);
    }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjCQ-zcT_xB12XkBftRS5tIVRyd8AJSdk&callback=myMap">
    </script>
 
   <!--script  src="/date/js/index.js"></script-->
   @endsection