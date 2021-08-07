@extends('admin.vadmin.lay')
@section('title') - 
إدارة الطلبيات
@endsection

@section('content')

<div class="container"> 
               
                <div class="container">
                  <div class="row">
                <div class="col-md-12">
                  @can('role-create')

       <a href="" data-toggle="modal" data-target="#add" class="btn btn-info float-left">
                                       <i class="fa fa-plus fa-2x"></i> اضافة طلبية جديد
                                       </a>
                                       @endcan

       </div></div>

       @if(count($orders)>0)
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>رقم الطلبية</th>
                    {{-- <th>رقم الصيدلية</th> --}}
                    <th>حالة الطلبية</th>
                    {{-- @can('role-edit') --}}
                    <th>تعديل</th>
                    {{-- @endcan --}}
                    {{-- @can('role-delete') --}}
                    <th>حذف</th>
                    {{-- @endcan --}}

                  </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                 <tr>
                   
                    <td>{{$order->id}}</td>
                    {{-- <td>{{$order->pharmacy_id}}</td> --}}
                    <td>{{$order->status_id}}</td>
                    {{-- @can('role-edit') --}}
                    <td> <a  href="" data-toggle="modal" data-target="#edit{{$order->id}}" class="btn btn-warning mr-3 ml-2">
                                       <i class="fa fa-edit fa-2x"></i>
                                       </a>
                                       
                                       
                                       

<div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="edit{{$order->id}}">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">  تعديل بيانات الطلبية {{$order->name}}</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                    {!! Form::open(['action' => ['App\Http\Controllers\OrderController@update',$order->id], 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                    
                    <div class="form-group">

            {{Form::label('status_id','حالة الطلبية')}}
            {{Form::text('status_id', $order->status_id, ['class' => 'form-control', 'placeholder' => 'الاسم'])}}
        </div>
        <div class="form-group">
        {{Form::label('total_pice','المجموع')}}
        {{Form::text('total_pice', $order->total_pice, ['class' => 'form-control', 'placeholder' => 'الاسم'])}}
       </div>
    <div class="form-group">
    {{Form::label('pharmacy_id','رقم الصيدلية')}}
    {{Form::text('pharmacy_id', $order->pharmacy_id, ['class' => 'form-control', 'placeholder' => 'الاسم'])}}
    </div>
  {{-- <div class="form-group">
  {{Form::label('user_id','رقم المستخدم')}}
  {{Form::text('user_id', $order->user_id, ['class' => 'form-control', 'placeholder' => 'الاسم'])}}
  </div> --}}

            {{Form::hidden('_method','PUT')}}
        
         </div>
                    <div class="modal-footer">
                      <button class="btn btn-primary" type="submit">  حفظ التعديلات</button>
                      {!! Form::close() !!}      
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">اغلاق</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

              </td>
              {{-- @endcan --}}


              {{-- @can('role-delete') --}}
              <td>
                    {!!Form::open(['action' => ['App\Http\Controllers\OrderController@destroy',$order->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                    {{Form::hidden('_method','DELETE')}}
                       <button class ="btn btn-danger mr-3 ml-3" type="submit"><i class="fa fa-md fa-trash"></i>
                       </button>
                       {!!Form::close()!!}
                    </td>
                    {{-- @endcan --}}

                    
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






<!--  data-backdrop="static" id="add" -->


<div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="add">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">  اضافة طلبية جديدة</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                    {!! Form::open(['action' => 'App\Http\Controllers\OrderController@store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                    {{Form::label('status_id','حالة الطلبية')}}
                    {{Form::text('status_id', $order->status_id, ['class' => 'form-control', 'placeholder' => 'الاسم'])}}
                </div>
                <div class="form-group">
                {{Form::label('total_pice','المجموع')}}
                {{Form::text('total_pice', $order->total_pice, ['class' => 'form-control', 'placeholder' => 'الاسم'])}}
               </div>
            <div class="form-group">
            {{Form::label('pharmacy_id','رقم الصيدلية')}}
            {{Form::text('pharmacy_id', $order->pharmacy_id, ['class' => 'form-control', 'placeholder' => 'الاسم'])}}
            </div>
        
        
 
                     </div>
                    <div class="modal-footer">
                      <button class="btn btn-primary" type="submit">  حفظ التعديلات</button>
                      {!! Form::close() !!}      
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">اغلاق</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
@endsection