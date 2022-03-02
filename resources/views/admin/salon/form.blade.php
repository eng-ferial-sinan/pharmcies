@extends('admin.vadmin.lay')

@section('head')   /
بيانات   الخدمةات

@endsection

@section('content')

<div class="tile ">

<div class="panel panel-default">
    @if ($item->id == null)
    <div class="panel-heading">
    اضافة   
    بيانات   
  </div>
  @else 
  <div class="panel-heading">
    تحرير   
    بيانات   
  {{$item->name }}  
</div>

  @endif
    
  <div class="panel-body">     
        <form method="post" action="@if ($item->id == null) {{ route('salon.store') }} @else {{ route('salon.update', ['salon' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif       
        <div class="form-group">
          {{Form::label('name','اسم الصالون ')}}
          {{Form::text('name', $item->name, ['class' => 'form-control', 'placeholder' => 'الاسم','required'=>true])}}
          </div>
          <div class="form-group">
            {{Form::label('city','المدينة')}}
            {{Form::text('city', $item->city, ['class' => 'form-control', 'placeholder' => 'المدينة','required'=>true])}}
            </div>
            <div class="form-group">
              {{Form::label('address','العنوان')}}
              {{Form::text('address', $item->address, ['class' => 'form-control', 'placeholder' => 'العنوان','required'=>true])}}
              </div>
              <div class="form-group">
                <input type="text" hidden name='map_1'value="{{$item->lat}}"    id ='map_1' >
                <input type="text"  hidden name='map_2' value="{{$item->lng}}"  id='map_2' >
            </div>
            <h4>الموقع</h4>
            <div class="form-group">
              <div id="cat_mapxx" style="height:250px;width:100%"></div>
            </div>
        
          <div class="form-group">
            {{Form::label('sort',' الترتيب')}}
            {{Form::number('sort',$item->sort, ['class' => 'form-control', 'placeholder' => 'الترتيب','required'=>true])}}
            </div>
          
        <div class="form-group">
          <img src="{{$item->image}}" class="img-rounded" height="50" width="70" alt="{{$item->name}}">
           <br/>
            {{Form::label('image','صورة معبرة')}}
             {{Form::file('image')}}
         </div>
                 </div>
              <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">حفظ </button>
                <a href="\admin\salon" class="btn btn-default" data-dismiss="modal">الغاء</a>
              </div>
        </form>
      </div>
</div>
    <script>
            function ConfirmDelete()
            {
            var x = confirm("هل تريد فعلاً الحذف؟");
            if (x)
              return true;
            else
              return false;
            }
          
    </script>
    
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
           document.getElementById("map_1").value = location.lat().toFixed(15);
           document.getElementById("map_2").value = location.lng().toFixed(15);
           map.setPosition(location);
       }
   
       </script>
       <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjCQ-zcT_xB12XkBftRS5tIVRyd8AJSdk&callback=myMap">
       </script>
    
      <!--script  src="/date/js/index.js"></script-->
      @endsection