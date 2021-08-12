@extends('admin.vadmin.lay')
@section('title') - 
إدارة الصيدليات
@endsection

@section('content')

<div class="container"> 
               
                <div class="container">
                  <div class="row">
                <div class="col-md-12">
                  {{-- @can('pharmacy-create') --}}
                  @if (auth()->user()->hasPermission('pharmacy-create'))

       <a href="" data-toggle="modal" data-target="#add" class="btn btn-info float-left">
                                       <i class="fa fa-plus fa-2x"></i> اضافة صيدلية جديدة
                                       </a>
                                       @endif
                                       {{-- @endcan --}}

       </div></div>

       @if(count($pharmacies)>0)
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>الصيدلية</th>
                    <th>العنوان</th>
                    <th>رقم الطلبية</th>
              @if (auth()->user()->hasPermission('pharmacy-edit'))
                    
                    {{-- @can('pharmacy-edit') --}}
                    <th>تعديل</th>
                    {{-- @endcan --}}
                    @endif
                    {{-- @can('pharmacy-delete') --}}
              @if (auth()->user()->hasPermission('pharmacy-delete'))

                    <th>حذف</th>
                    {{-- @endcan --}}
                    @endif

                  </tr>
                </thead>
                <tbody>
                @foreach($pharmacies as $pharmacy)
                 <tr>
                  <td>{{$pharmacy->id}} </td>
                    <td>{{$pharmacy->name}}</td>
                    <td>{{$pharmacy->address}}</td>
                    <td>
                      {{$pharmacy->order_count}}
                       {{-- <a  href="" data-toggle="modal" data-target="#edits{{$pharmacy->id}}" class="btn btn-warning mr-3 ml-2">
                        <i class="fa fa-edit fa-2x"></i>
                        </a> --}}
                        
                    </td>

                    <td> <a  href="" data-toggle="modal" data-target="#edit{{$pharmacy->id}}" class="btn btn-warning mr-3 ml-2">
                                       <i class="fa fa-edit fa-2x"></i>
                                       </a>
                                       
                                       
                                       

<div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="edit{{$pharmacy->id}}">
                <div class="modal-dialog" pharmacy="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">  تعديل بيانات الصيدلية {{$pharmacy->id}}</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                    {!! Form::open(['action' => ['App\Http\Controllers\PharmacyController@update',$pharmacy->id], 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                    
           <div class="form-group">

            {{Form::label('name','الصيدلية')}}
            {{Form::text('name', $pharmacy->name, ['class' => 'form-control', 'placeholder' => ''])}}
          </div>
        <div class="form-group">

          {{Form::label('phone','الهاتف')}}
          {{Form::text('phone', $pharmacy->phone, ['class' => 'form-control', 'placeholder' => ''])}}
       </div> 
       <div class="form-group">

        {{Form::label('address','العنوان')}}
        {{Form::text('address', $pharmacy->address, ['class' => 'form-control', 'placeholder' => ''])}}
       </div>  
      {{-- <div class="form-group">
      {{Form::label('lat','الطول')}}
      {{Form::text('lat', $pharmacy->lat, ['class' => 'form-control', 'placeholder' => ''])}}
     </div>
     <div class="form-group">
      {{Form::label('lng','العرض')}}
      {{Form::text('lng', $pharmacy->lng, ['class' => 'form-control', 'placeholder' => ''])}}
     </div> --}}
     <div class="form-group">
      {{Form::label('order_count','رقم الطلبية')}}
      {{Form::text('order_count', $pharmacy->order_count, ['class' => 'form-control', 'placeholder' => ''])}}
     </div>
     <div class="form-group">
      {{Form::label('balance','الميزانية')}}
      {{Form::text('balance', $pharmacy->balance, ['class' => 'form-control', 'placeholder' => ''])}}
     </div>
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
            
              <td>
                    {!!Form::open(['action' => ['App\Http\Controllers\PharmacyController@destroy',$pharmacy->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                    {{Form::hidden('_method','DELETE')}}
                       <button class ="btn btn-danger mr-3 ml-3" type="submit"><i class="fa fa-md fa-trash"></i>
                       </button>
                       {!!Form::close()!!}
                    </td>
                      

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


        
        
 
                    
                    <div class="modal-footer">
                      <button class="btn btn-primary" type="submit">  حفظ التعديلات</button>
                      {!! Form::close() !!}      
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">اغلاق</button>
                    </div>
                 
@endsection

@section('script')
<script src="/js/repeater.js" type="text/javascript"></script>
    <script>
        /* Create Repeater */
        $("#repeater").createRepeater({
            showFirstItemToDefault: true,
        });
    </script>
 
 @endsection
       