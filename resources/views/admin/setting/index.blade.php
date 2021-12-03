@extends('admin.vadmin.lay')
@section('title') /
 <span class="badge badge-info">

     تعديل  البيانات الاساسية للموقع :
</span>
@endsection
@section('content')
<!--link rel="stylesheet" href="/date/css/style.css"-->

 
  <div class="md-form text-right text-black col-md-12 card p-2 m-1">
    <h5 class="btn-info p-2">
     تعديل  البيانات الاساسية للموقع :
</h5>
 
  <form action="/admin/settings" method="post" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}
             
            <div class="form-row">
                    <div class="col-md-6">
                        <label for="from" class="font-weight-bold text-right js">     اسم الشركة     </label>
                        <input type="text" name="nameAr" id="nameAr" class="form-control" required  value="{{$info->nameAr}}">
                        <input type="hidden" name="num" id="num" class="form-control" required  value="{{$info->id}}">
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                                <label for="from" class="font-weight-bold text-right js">     company Name   </label>
                            <input type="text" name="nameEn" id="nameEn" class="form-control"  value="{{$info->nameEn}}">
                        </div> 
                    </div>
            </div> 
            <div class="form-row">
                <label for="address" class="font-weight-bold text-right js"> العنوان      </label>
                <textarea name="address" id="address" class="form-control">{{$info->address}}
                </textarea>   
            </div>
            
        <div class="form-row">
                <div class="col-md-6">
                    <label for="from" class="font-weight-bold text-right js">    تلفون    </label>
                    <input type="text" name="phone" id="phone" class="form-control" required  value="{{$info->phone}}">
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                            <label for="from" class="font-weight-bold text-right js">     البريد الإلكتروني  email   </label>
                        <input type="email" name="email" id="e_name" class="form-control"  value="{{$info->email}}">
                    </div> 
                </div>
        </div> 
        <div class="form-row">
            <div class="col-md-6">
                <label for="from" class="font-weight-bold text-right js">    فيس بوك    </label>
                <input type="text" name="facebook" id="facebook" class="form-control"   value="{{$info->facebook}}">
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                        <label for="from" class="font-weight-bold text-right js">   حساب تويتر     </label>
                    <input type="twitter" name="twitter" id="e_name" class="form-control"  value="{{$info->twitter}}">
                </div> 
            </div>
       </div> 
       <div class="form-row">
                    <div class="col-md-6">
                        <label for="from" class="font-weight-bold text-right js">    انستجرام    </label>
                        <input type="text" name="instagram" id="instagram" class="form-control"   value="{{$info->instagram}}">
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                                <label for="from" class="font-weight-bold text-right js">  حساب جوجل بلاس  </label>
                            <input type="google_plus" name="google_plus" id="e_name" class="form-control"  value="{{$info->google_plus}}">
                        </div> 
                    </div>
        </div>
            <div class="form-group">
                <input type="text" hidden name='map_1'value="{{$info->lat}}"    id ='map_1' >
                <input type="text"  hidden name='map_2' value="{{$info->lng}}"  id='map_2' >
            </div>

             <div class="form-group">
            <label for="asolgan" class="font-weight-bold text-right js"> شعار الشركة    </label>
                <img src="{{$info->image}}" class="img-rounded" height="50" width="70" alt="{{$info->nameAr}}">
                 <br/>
                  {{Form::label('image','صورة معبرة')}}
                   {{Form::file('image')}}
               </div>
           <div class="form-group">
                <div id="cat_mapxx" style="height:250px;width:100%"></div>
           </div>
           
           @can('edit settings')
           <div class="form-group">
            {{Form::submit('حفظ التعديلات',['class'=>'btn btn-primary'])}} 
            </div>   
           @endcan
           
            </form>
          
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
                      (document.getElementById("map_1").value ? document.getElementById("map_1").value : 15.344),
                      (document.getElementById("map_2").value ?document.getElementById("map_2").value : 44.185));
               
        var mapOptions = {center: myCenter, zoom: 15};
            map = new google.maps.Map(mapCanvas, mapOptions);
          <?php if(!is_null($info->lat)) {?>
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
        document.getElementById("map_1").value = location.lat().toFixed(15);
        document.getElementById("map_2").value = location.lng().toFixed(15);
        map.setPosition(location);
    }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjCQ-zcT_xB12XkBftRS5tIVRyd8AJSdk&callback=myMap">
    </script>
 
   <!--script  src="/date/js/index.js"></script-->
   @endsection