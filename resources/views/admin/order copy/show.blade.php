@extends('admin.vadmin.lay')

@section('title') - 
        تفاصيل الطلب  رقم {{$order->id}}
         @endsection
@section('content')
  
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="text-left mt-0 d-print-none" >
              <a href="/admin/anyorder" class="btn btn-light custom-btn">رجوع </a>
             </h3>
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-12">
                    
                    <h3 class="page-header">
                    <img src="/logo.png" width="80" height="70">
                    </h3>
                 
                      
                  </div>
               
                  </div>
                <div class="row invoice-info">
                 
                  <div class="col-md-3 col-sm-12"> 

                     @if(!$order->web)
                      @if($order->user)
                        <address><strong>اسم العميل:   {{$order->user->name}}</strong>   
                        @if($order->user->type)
                        {{$order->user->type->name}}
                          
                        @else
                        @endif
                          <br><strong>تلفون:</strong>
                          <a href="tel:{{str_replace("+967","", $order->user->phone)}}">
                          {{str_replace("+967","", $order->user->phone)}}
                          </a>
                          <br> <strong>عنوان: </strong>
                        
                          {{$order->address?$order->address->desc:'لايوجد'}} 
                                        
                          </address>
                          @else غير متوفر
                      @endif
                      @else

                        <address><strong>اسم العميل:   {{$order->name}}</strong>   
                          <br><strong>تلفون:</strong>
                          <a href="tel:{{str_replace("+967","", $order->phone)}}">
                          {{str_replace("+967","", $order->phone)}}
                          </a>
                          <br> <strong>عنوان: </strong>
                          {{$order->address?$order->address->desc:'لايوجد'}} 
                          <br>
                          <strong>تم الطلب بواسطة :   {{$order->user?$order->user->name:'غير موجود'}}</strong>  
                          </address>
                      @endif   
                    </div>
                <div class="col-md-3 col-sm-12">
                          <b>  رقم الطلب :</b> {{$order->id}}<br>
                        <b>   تاريخ:  </b>
                          
                          {{$order->created_at->diffForHumans()}}
                          <br>
                      <b>   السوبرماركت:  </b>
                      {{$order->store?$order->store->name:'لايوجد'}} 
                      <br>
                      
                </div>
                <div class="col-md-3 col-sm-12"> 

              
                  @if($order->mosted)
                    <address><strong>المستعد : {{$order->mosted->name}}</strong>   
                      <br><strong>تلفون:</strong>
                      <a href="tel:{{str_replace("+967","", $order->mosted->phone)}}">
                      {{str_replace("+967","", $order->mosted->phone)}}
                      </a>
                      <br> 
                      <strong>عنوان: </strong>
                  <?php
                  $reply=\App\reply::where('order_id',$order->id)->first() 
                  ?>
                      {{$reply->address?$reply->address->desc:'لايوجد'}} 
                      </address>
                      @else  غير متوفر مستعد بعد
                      @endif
                      
                </div>

                  <div class="col-md-3 col-sm-12">
                      <b>  الحالة   :</b>
                      <span id="status_text">
                        {{$order->statusName?$order->statusName->ar_name:"-"}} </span>
                        <br>
                      <a onclick="$('#status').show();$('#driver').hide();" class="ml-3 d-print-none btn btn-outline-secondary float-left"><i class="fa fa-edit"></i>تغير الحالة</a>

                      {{-- <a onclick="$('#driver').show();$('#status').hide();" class="btn d-print-none btn-outline-secondary float-left"><i class="fa fa-edit"></i>تغير سائق</a> --}}
                    
                 <div id="status" style="display:none" >
                 <select name="status" id="status_id"  class="custom-select"> 
                  <option value=""  > حدد الحالة</option>
                  @foreach(\App\OrderStauts::all() as $driver)
                  <option value="{{$driver->id}}" @if($order->status== $driver->id) selected @endif> {{$driver->ar_name}} </option>
                  @endforeach
              </select>                  
           <a id="status_save" class="btn btn-outline-secondary float-left"><i class="fa fa-edit"></i>حفظ الحالة  </a>

            </div>
               
                  
                 
              
                 </div>
              </div>
              <div class="row">
                <div class="bs-component col-6">

                <div >

                  الطلبية : 
                  <br>
                  <br>
                 <strong>{{$order->desc}}</strong> 
                </div>

                </div>
             
                  <div class="bs-component col-6">

                        <div class="form-group  ">
                            <input type="hidden" name='map_1'value="{{$order->address?$order->address->latitude:15.344}}" id = 'map_1'>
                            <input type="hidden" name='map_2' value="{{$order->address?$order->address->longitude:14.344}}"  id='map_2' >
                        </div>
                        <div class="form-group">
                                <div id="cat_mapxx" style="height:250px;width:100%"></div>
                            </div>
                        </div>
                  </div>

                    <div class="row d-print-none mt-2">
                            <div class="col-12 text-left">
                            <a class="btn btn-primary" href="javascript:window.print();" ><i class="fa fa-print"></i> طباعة</a>
                            
                         
                            </div>       
                          </div>
                        </div>
                      </section>
          </div>
        </div>
      </div>
    
      @endsection

   @section('script')
    <script type="text/javascript">
   

   $( "#status_save" ).click(function() {    
       
       var status_id = $('#status_id').val();   
       
       if(status_id){
         $('#status_save').html('جاري حفظ الحالة ') ;
           $.ajax({
              type:"GET",
              url:"{{url('/admin/setStatus1')}}?s_id="+status_id+"&order_id={{$order->id}}",
              success:function(res){               
               if(res){
                   $('#status_text').html(res) ;
                    
                    $('#status').hide() ;
                   alert('تم.  تغير الحالة الي  ' + res);
                   $('#status_save').html('  حفظ الحالة     ') ;
   
               }else{
                  alert('عفوا..تعذر تغير الحالة   ');
                }
              }
           });
       }else{
                 
       }      
      });
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