@extends('admin.vadmin.lay')

@section('title')   /
بيانات   
    الصوالين

@endsection


@section('content')

<div class="container"> 


    <div class="row">
        <div class="col-md-12  " style="text-align: center;">
          @can('add salon')
          <a href="" data-toggle="modal" data-target="#add" class="btn btn-info float-left">
                    <i class="fa fa-plus fa-2x"></i> اضافة صالون
                </a>
            @endcan

    </div>
</div>

@if(count($salons)>0)
<div class="row">
 <div class="col-md-12">
   <div class="tile">
     <div class="tile-body">
       <div class="table-responsive">
       <table class="table table-hover table-bordered " id="sampleTable">
                        <thead>
                       <tr>
                    <th>#</th>
                    <th>#</th>
                    <th>الصالون</th>
                    @can('edit salon')
                    <th>-</th>
                    @endcan
                    @can('delete salon')
                    <th>-</th>
                    @endcan
                </tr>
                </thead>
                <tbody>  
                    @foreach($salons as $salon)
                    <tr>
                    <td>{{$salon->id}} </td>
                    <td><img src="{{$salon->image}}" height="80" width="75"></td>

                    <td>{{$salon->name}}</a></td>

            
                    @can('edit salon')
                    <td> <a  href="/admin/salon/{{$salon->id}}/edit" class="btn btn-warning mr-3 ml-2">
                        <i class="fa fa-edit fa-2x"></i>
                        </a>
                
                     
                    @endcan
                    
                
                    @can('delete salon')
                    <td>

 
                        {!!Form::open(['action' => ['App\Http\Controllers\SalonController@destroy',$salon->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('الحذف',['class'=>'btn btn-danger'])}}
                        {!!Form::close()!!}
                       
                        
                    </td>

                    @endcan
      
                </tr>
                    @endforeach 
                
                    </tbody>

                </table>
            </div>
        </div>
      </div>
      </div>
    </div>
    @else
    <p> لا توجد بيانات حالياً</p>
@endif
                
</div>
    
<div class="modal fade" id="add">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">  اضافة صالون  جديد</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {!! Form::open(['action' => 'App\Http\Controllers\SalonController@store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
         
  <div class="form-group">
  {{Form::label('name','اسم الصالون ')}}
  {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'الاسم','required'=>true])}}
  </div>
  <div class="form-group">
    {{Form::label('city','المدينة')}}
    {{Form::text('city', '', ['class' => 'form-control', 'placeholder' => 'الاسم','required'=>true])}}
    </div>
    <div class="form-group">
      {{Form::label('address','العنوان')}}
      {{Form::text('address', '', ['class' => 'form-control', 'placeholder' => 'الاسم','required'=>true])}}
      </div>
      <div class="form-group">
        <input type="text" hidden name='map_1'    id ='map_1' >
        <input type="text"  hidden name='map_2'  id='map_2'  >
    </div>
    <h4>الموقع</h4>
    <div class="form-group">
      <div id="cat_mapxx" style="height:250px;width:100%"></div>
    </div>

  <div class="form-group">
    {{Form::label('sort',' الترتيب')}}
    {{Form::number('sort',0, ['class' => 'form-control', 'placeholder' => 'الترتيب','required'=>true])}}
    </div>
  
  <div class="form-group">
     <br/>
      {{Form::label('image','صورة معبرة')}}
       {{Form::file('image')}}
   </div>
           </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-primary">حفظ </button>
          <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  

<script>      
    function ConfirmDelete( )
    {
       var msg = "هل تريد فعلاً   حذف  "+"?";
    var x = confirm(    msg);
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