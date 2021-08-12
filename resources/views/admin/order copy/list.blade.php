@extends('admin.vadmin.lay')

@section('content')
<div class="container"> 
  
<style>
@media only screen and (min-width :500px) {
 .table-responsive {
    display: inline-table;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}
}
@media only screen and (max-width :500px) {
 .table-responsive {
    display:block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}
}

   
</style>
<style>
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
</style>
          
<div class="row justify-content-around" style=" display: flex;
        align-items: flex-end;">
            <div class="col-6  pull-right">
            <h3> 
              <i class="fa fa-th-list"></i>      قائمة الطلبات
            </h3>
          </div>
            <div class="col-6 pull-left ">
              <div class="form-group " >
               <a href="/order/create" class="btn btn-success custom-btn"> اضافة طلب جديد</a>
              </div>
              </div>
        </div>
      <div class="row">
        <div class="col-md-12">
         
<!--           
<div class="dropdown">
  <button class="dropbtn">Dropdown</button>
  <div class="dropdown-content">
  <a href="#">Link 1</a>
  <a href="#">Link 2</a>
  <a href="#">Link 3</a>
  </div>
</div>
-->

{{-- <form action="/admin/anyorder" method="get">
    <div cla>
    <select class="form-control font-weight-bold text-right js col-md-3" name="myselect" id="status" onchange="this.form.submit()">
          <option value="-1">اختر الحالة</option>
     @foreach($status as $sta)
        <option value="{{$sta->id}}">{{$sta->ar_name}}</option>
    @endforeach
         <option value="-1">االكل</option>
    </select>
</form> --}}
<style>
  .bg-web{
    background-color: #31be35;
  }
</style>
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered table-responsive" >
                <thead>
                  <tr >
                    <th>رقم الطلب  </th>
                    <th>  اسم المستخدم</th>
                    <th>نص الطلب</th>
                    <th>حالة الطلب</th>
                    <th> العروض</th>
                    <th> التاريخ   </th>
                     <th> تتبع الطلب </th>
                     @can('order-edit')  
                    <th>تفاصيل      </th>
                    @endcan

                  </tr>
                </thead>
                <tbody>
                  @foreach($items as $item)
                  <tr class="{{$item->web? 'bg-web':''}}">
                    <td>{{$item->id}}</td>
                    
                    <td> 
                    @if($item->user)
                    {{$item->user->name}} ({{$item->user->orders->where('id','<=',$item->id)->count()}})
                    <br>
                      <?php $phone =str_replace('+967','',$item->user->phone);?>
                    <a href="tel:{{$phone}}" >

                    {{$phone}}
                    </a>
                    @endif 

                    </td>
                    <td> 
                      {{$item->desc}} 
  
                      </td>
                       <td> 
                             <span  id="s_text{{$item->id}}"> 
                              {{$item->statusName?$item->statusName->ar_name:"-"}}
                          </span>
                          <select name="order_status_id" id="cs{{$item->id}}" onChange="changeStatus('{{$item->id}}')" class="form-control" style="padding:0px">
                                  <?php  $sort = 0 ; ?>
                                
                                  @foreach( $status as $da)
                                      <option value="{{$da->id}}"     @if ($item->status == $da->id) selected @endif>
                                          {{$da->ar_name}}
                                      </option>
                                  @endforeach
                          </select>
                          <script>
                            function changeStatus(id) {
                                oid= id ;
                                sid = $('#cs'+id).val() ;
                                $.ajax({
                                      type:"GET",
                                      url:"{{url('/admin/setStatus1')}}?s_id="+sid+"&order_id="+oid,
                                      success:function(res){               
                                  
                                        if(res){
                                          alert('تم.  تغير الحالة الي  ' + res);
                                             $('#s_text'+id).html(res) ;
                                          
                                          }else{
                                          alert('عفوا..تعذر تغير الحالة   ');
                                        }
                                          }
                                        ,
                                    error: function(error) {
                                       
                                      }
                                    });
                        
                                                    }
                            </script>
                      
                      </td>
                       <td>
                 @if(count($item->reply)>0)
                        <a  href="" data-toggle="modal" data-target="#show{{$item->id}}" class="btn btn-warning mr-3 ml-2">
                           العروض
                          </a>
                          
                          
                          
  
  <div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="show{{$item->id}}">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title">   العروض   </h5>
         <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
       </div>
       <div class="modal-body">
        <table class="table table-hover table-bordered table-responsive sampleTable">
              <thead>
                <tr >
                  <th>المستعد   </th>
                  <th>  العرض </th>
                  <th> الوصف</th>
                  @if($item->status<=3)
                  <th> الموافقة</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                 
            @foreach ($item->reply as $repl)
            <tr style="{{$item->user_id == $repl->acount_id ? 'background-color:#95e474' : '' }}">
              <td><address><strong>المستعد : {{$repl->user?$repl->user->name:""}}</strong>   
                <br><strong>تلفون:</strong>
                <a href="tel:{{str_replace("+967","", $repl->user?$repl->user->phone:"")}}">
                {{str_replace("+967","", $repl->user?$repl->user->phone:"")}}
                </a>
                <br> 
                <strong>عنوان: </strong>
                {{$repl->address?$repl->address->desc:'لايوجد'}} 
                </address>
              
              </td>
              <td> السعر  :  {{$repl->price }} <br>
                سعر التوصيل  :  {{$repl->delivery_price }}
              </td>
              <td>{{$repl->desc}}</td>
              @if($item->status<=3)
              <td>   
                {!!Form::open(['action' => ['admin\orderController@agreereply',$repl->id],'method'=>'POST', 'class'=>'pull-right' ])!!}
                {{-- {{Form::hidden('_method','GET')}} --}}
                {{Form::submit('نعم',['class'=>'btn btn-info'])}}
                {!!Form::close()!!}</td>
                @endif
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
  لايوجد رد
  @endif
                          
                        
                        </td>
  
                    <td>{{$item->created_at}}</td>
                    <td>
                      <a  href="" data-toggle="modal" data-target="#edit{{$item->id}}" class="btn btn-warning mr-3 ml-2">
                        تتبع الطلب
                        </a>
                        
                        
                        

<div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="edit{{$item->id}}">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title">  تتبع الطلب   </h5>
       <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
     </div>
     <div class="modal-body">
      <table class="table table-hover table-bordered table-responsive sampleTable">
            <thead>
              <tr >
                <th>الحالة   </th>
                <th>  الوقت </th>
                <th>التاريخ </th>
              </tr>
            </thead>
            <tbody>
                <tr>
                <td>انشاء الطلب</td>
                <td>{{date('H:i:s A',strtotime($item->created_at))}}</td>
                <td>{{date('Y-m-d',strtotime($item->created_at))}}</td>
              </tr>
          @foreach ($item->Logs as $Log)
          <tr>
            <td>{{$Log->statusName?$Log->statusName->ar_name:""}}</td>
            <td>{{date('H:i:s A',strtotime($Log->updated_at))}}</td>
            <td>{{date('Y-m-d',strtotime($Log->updated_at))}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
     
   </div>
 </div>
</div>
</div>

                        
                      
                      </td>
                    @can('order-edit')  
                    <td> 
                      <a class="btn btn-primary" href="/admin/anyorder/{{$item->id}}"><i class="fa fa-lg fa-eye"></i>تفاصيل</a>
                    </td>
                    @endcan

                   
                   
                   </tr>
                   @endforeach

                 
                   </tbody>
              </table>
              {{ $items->appends(['service_id' => (isset($filter['service_id'])?$filter['service_id']:''),'acount_id'=>(isset($filter['acount_id'])?$filter['acount_id']:''),'status'=>(isset($filter['status'])?$filter['status']:''),'search'=>(isset($filter['search'])?$filter['search']:'')])->links() }}

              {{-- {{$items->links()}} --}}
            </div>
          </div>
        </div>
      </div>
      @endsection
     
   @section('script')
<script>

 
$('.select2').select2();  
                   
 $('.js-example-basic-single').select2();

  $('.counter_id').select2({
        width: '100%',
        dropdownParent: $("#add")
    })
   
       
   </script>

<!--script  src="/date/js/index.js"></script-->
@endsection