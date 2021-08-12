@extends('admin.vadmin.lay')

@section('title') - 
        تفاصيل الطلب  رقم {{$order->id}}
         @endsection
@section('content')
 
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header">
                  <img src="/logo.png" width="60" height="60">
                    {{sitinfo()->ar_name}}
                    
                    {{
                      $order->total 
                    }}
                    </h2>
                </div>
                <div class="col-6">
                 </div>
              </div>
              <div class="row invoice-info">
                 
                <div class="col-4"> 

              
                @if($order->user)
                  <address><strong>اسم العميل:   {{$order->user->name}}</strong>   
                  @if($order->user->type)
                  {{$order->user->type->name}}
                    
                   @else
                     @endif
                    <br><strong>تلفون:</strong> {{$order->user->phone}}
                    <br> <strong>عنوان: </strong>
                    {{count($order->user->addresses)>0?$order->user->addresses[0]->desc:'لايوجد'}} 
                    <br><strong> المسافة: </strong>
                    <?php $km = "غير متوفر" ;
                    $distance=1 ;
                    if(count($order->user->addresses)>0) {
                    $distance= \App\MarketAddress::where('market_id',$order->market->id)->where('address_id',$order->user->addresses[0]->id)->first();
                    if($distance) $km=$distance->km;
                    }?>
                    {{$km
                    }}  كم             
                     </address>
                    @else غير متوفر
                    @endif
                    
                </div>
                <div class="col-4"><b>  رقم الطلب :</b> {{$order->id}}<br>
               <b>   تاريخ:  </b>
                  
                  {{$order->created_at}}
                  <br>
               <b>   السوبرماركت:  </b>
                  
               {{$order->market->name}}
               <br>
               <b>  السائق   :</b>
                <span id="dname">
                  {{$order->driver?$order->driver->name:"-"}} </span>
                 </div>
                 <div class="col-4">
                 <b>  الحالة   :</b>
                <span id="status_text">
                  {{$order->statusName?$order->statusName->ar_name:"-"}} </span>
                  <br>
                 <a onclick="$('#status').show();$('#driver').hide();" class="ml-3 btn btn-outline-secondary float-left"><i class="fa fa-edit"></i>تغير الحالة</a>

                 <a onclick="$('#driver').show();$('#status').hide();" class="btn btn-outline-secondary float-left"><i class="fa fa-edit"></i>تغير سائق</a>
              
                 <div id="status" style="display:none" >
                 <select name="status" id="status_id"  class="custom-select"  >
                 
<option value=""  > حدد الحالة</option>
@foreach(\App\OrderStauts::all() as $driver)
<option value="{{$driver->id}}" @if($order->status== $driver->id) selected @endif> {{$driver->ar_name}} </option>
@endforeach


</select>                  <a id="status_save" class="btn btn-outline-secondary float-left"><i class="fa fa-edit"></i>حفظ الحالة  </a>

</div>
               <div id="driver" style="display:none" >
                 <select name="driver" id="driver_id"  class="custom-select"  >
                 
<option value=""  > حدد السائق الاقرب</option>
@foreach($drivers as $driver)
<option value="{{$driver->id}}" @if($order->delivery_man_id== $driver->id) selected @endif> {{$driver->name.'('.$driver->distance.')'}} </option>
@endforeach


</select>                  <a id="esnad" class="btn btn-outline-secondary float-left"><i class="fa-edit"></i>اسناد السائق</a>

</div>
                  
                 
              
                 </div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>الكمية</th>
                        <th>اسم المنتج</th>
                        <th>رقم المنتج</th>
                        <th>سعر الوحدة</th>
                        <th>اجمالي </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0 ;$discount  =  1 ; ?>
@foreach($items as  $item)
<?php
$product =  ($item->product) ;
$price =$product->price; 
$discount  =  1 ;
?>
                      <tr>
                        <td>{{$item->item_no}}</td>
                        <td> {{$product->name}}</td>
                        <td>{{$product->id}}</td>
                        <td>{{number_format($price)}}</td>
                        <td>{{number_format($price * $item->item_no)}}
                       
                        </td>
                      </tr>
                      <?php $total +=$price * $item->item_no ; ?>
         @endforeach              
                       
          
                    </tbody>
                  </table>
                  <style>
                  .list-group-item {
     
    padding: 0.75rem 1.25rem;
    margin-bottom: -1px;
    background-color: #FFF;
    border: 0px solid rgba(0, 0, 0, 0.125);
}
                  </style>
                  <div class="bs-component col-4">
              <ul class="list-group">
                <li class="list-group-item">
                الاجمالي     
                        : 
                        {{number_format($total*$discount)}}
                           </li>
                <li class="list-group-item">سعر التوصيل:{{$order->delivery_price}} </li>
                <li class="list-group-item"> @if($order->user)
                        التخفيض :0.0 
                         %
                        <?php ;?>
                        @endif</li>
                        <li class="list-group-item"> الاجمالي الكلي:{{number_format($total*$discount)}}
                         </li>
              </ul>
             
              </div>
              <div class="row d-print-none mt-2">
                <div class="col-12 text-left"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> طباعة</a>
                
                {!!Form::open(['action' => ['orderController@destroy',$order->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return onsub()'])!!}
                       {{Form::hidden('_method','DELETE')}}
                       <button class ="btn btn-danger" type="submit"><i class="fa fa-lg fa-trash"></i>
                      حذف</button>
                    
                       {!!Form::close()!!}
                </div>
               
                      
 
              </div>
            </section>
          </div>
        </div>
      </div>
    
      @endsection

   @section('script')
    <script type="text/javascript">
    $( "#esnad" ).click(function() {    
       
    var driver_id = $('#driver_id').val();   
    
    if(driver_id){
      $('#esnad').html('جاري اسناد السائق ') ;
        $.ajax({
           type:"GET",
           url:"{{url('/admin/ordersetdriver')}}?driver_id="+driver_id+"&order_id={{$order->id}}",
           success:function(res){               
            if(res){
                $('#dname').html(res) ;
               
                 $('#driver').hide() ;
                alert('تم. اسناد السائق ' + ":"+ res);
                $('#esnad').html(' اسناد السائق ') ;

            }else{
               alert('عفوا..تعذر اسناد السائق ');
             }
           }
        });
    }else{
              
    }      
   });

   $( "#status_save" ).click(function() {    
       
       var status_id = $('#status_id').val();   
       
       if(status_id){
         $('#status_save').html('جاري حفظ الحالة ') ;
           $.ajax({
              type:"GET",
              url:"{{url('/admin/setStatus')}}?s_id="+status_id+"&order_id={{$order->id}}",
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




@endsection