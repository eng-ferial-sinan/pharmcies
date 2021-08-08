@extends('admin.vadmin.lay')
@section('title') - 
إدارة الادوية
@endsection

@section('content')

<div class="container"> 
               
                <div class="container">
                  <div class="row">
                <div class="col-md-12">
                  @if (auth()->user()->hasPermission('medicine-create'))
       <a href="" data-toggle="modal" data-target="#add" class="btn btn-info float-left">
                                       <i class="fa fa-plus fa-2x"></i> اضافة دواء
                                       </a>
                                       @endif

       </div></div>

       @if(count($medicines)>0)
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>الاسم</th>
                    <th>الصنف</th>
                    <th>السعر</th>
                    <th>تاريخ الانتاج</th>
                    <th>تاريخ الانتهاء</th>
                    @if (auth()->user()->hasPermission('medicine-edit'))
                    <th>تعديل</th>
                    @endif
                    @if (auth()->user()->hasPermission('medicine-delete'))
                    <th>حذف</th>
                    @endif

                  </tr>
                </thead>
                <tbody>
                @foreach($medicines as $medicine)
                 <tr>
                   
                    <td>{{$medicine->name}}</td>
                    <td>{{$medicine->category_id}}</td>
                    <td>{{$medicine->price}}</td>
                    <td>{{$medicine->production_date}}</td>
                    <td>{{$medicine->expiry_date}}</td>
                    @if (auth()->user()->hasPermission('medicine-edit'))
                    <td> <a  href="" data-toggle="modal" data-target="#edit{{$medicine->id}}" class="btn btn-warning mr-3 ml-2">
                                       <i class="fa fa-edit fa-2x"></i>
                                       </a>
                                       
                                       
                                       

<div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="edit{{$medicine->id}}">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">  تعديل بيانات الدواء {{$medicine->name}}</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                    {!! Form::open(['action' => ['App\Http\Controllers\MedicineController@update',$medicine->id], 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                    
                    <div class="form-group">

            {{Form::label('name','اسم الدواء')}}
            {{Form::text('name', $medicine->name, ['class' => 'form-control', 'placeholder' => 'الاسم'])}}
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
              @endif

              @if (auth()->user()->hasPermission('medicine-delete'))
              <td>
                    {!!Form::open(['action' => ['App\Http\Controllers\MedicineController@destroy',$medicine->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                    {{Form::hidden('_method','DELETE')}}
                       <button class ="btn btn-danger mr-3 ml-3" type="submit"><i class="fa fa-md fa-trash"></i>
                       </button>
                       {!!Form::close()!!}
                    </td>
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
                        <p> لا توجد بيانات حالياً</p>
                    @endif
        </div>






<!--  data-backdrop="static" id="add" -->


<div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="add">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">  اضافة دواء جديد</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                    {!! Form::open(['action' => 'App\Http\Controllers\MedicineController@store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                   
        <div class="form-group">
            {{Form::label('name','اسم الدواء')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'الاسم'])}}
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