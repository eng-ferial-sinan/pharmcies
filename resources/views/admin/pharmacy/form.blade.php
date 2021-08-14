@extends('admin.vadmin.lay')

@section('head')   /
بيانات   
  الصيدلية

@endsection

@section('content')

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
  {{$item->name }}  </div>

  @endif
    
                    </h3>


      <div class="tile ">
            
        <form method="post" action="@if ($item->id == null) {{ route('pharmacy.store') }} @else {{ route('pharmacy.update', ['pharmacy' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

       <div class="form-group">
            {{Form::label('name','الصيدلية')}}
            {{Form::text('name', $item->name, ['class' => 'form-control', 'placeholder' => '','required'=>true])}}
        </div>
        <div class="form-group">
          {{Form::label('phone','رقم التلفون')}}
          {{Form::text('phone', $item->phone, ['class' => 'form-control', 'placeholder' => '','required'=>true])}}
      </div>
        <div class="form-group">
          {{Form::label('address','العنوان')}}
          {{Form::text('address', $item->address, ['class' => 'form-control', 'placeholder' => '','required'=>true])}}
      </div> 
           @php
               $users = \App\Models\User::where('user_type','صيدلية')->pluck('name', 'id')->toArray();
           @endphp
           
    <div class="form-group" >
      {{Form::label('user_id','المستخدم')}}
      {{Form::select('user_id', $users,$item->user_id, ['class' => 'form-control newRead js-example-basic-single','id' => 'custmer_id', 'placeholder' => ' المستخدم'])}}
    </div>
    <div class="form-group">
      <img src="{{$item->image}}" class="img-rounded" height="50" width="70" alt="{{$item->name}}">
       <br/>
        {{Form::label('image','صورة معبرة')}}
         {{Form::file('image')}}
     </div>
    <div class="form-group">
      <input type="text" name='lat'value="{{$item->lat}}"    id = 'map_1' required>
      
      <input type="text" name='lng' value="{{$item->lng}}"  id='map_2' required>
              </div>

      <div class="form-group">
           <div id="cat_mapxx" style="height:250px;width:100%"></div>
      </div>

    {{Form::submit('حفظ',['class'=>'btn btn-primary'])}}    
    {!! Form::close() !!}   
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
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjCQ-zcT_xB12XkBftRS5tIVRyd8AJSdk&callback=myMap"></script>
   

@endsection
@section('script')
<script src="/app.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.dropdown.css">
<script src="/js/jquery.dropdown.js"></script>
<script>

    $('.dropdown-sin-1').dropdown({
      readOnly: true,
      input: '<input type="text" maxLength="20" placeholder="Search">'
    });

  
  </script>
      @endsection
