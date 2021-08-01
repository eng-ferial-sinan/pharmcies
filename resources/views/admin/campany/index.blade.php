@extends('admin.vadmin.lay')
@section('title') - 
إدارة الشركات
@endsection

@section('content')

<div class="container"> 
               
                <div class="container">
                  <div class="row">
                <div class="col-md-12">
                  @can('role-create')
       <a href="" data-toggle="modal" data-target="#add" class="btn btn-info float-left">
                                       <i class="fa fa-plus fa-2x"></i> اضافة شركة 
                                       </a>
                                       @endcan

       </div></div>

       @if(count($collages)>0)
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>الاسم</th>
                    @can('role-edit')
                    <th>تعديل</th>
                    @endcan
                    @can('role-delete')
                    <th>حذف</th>
                    @endcan
                  </tr>
                </thead>
                <tbody>
                @foreach($collages as $collage)
                 <tr>
                   
                    <td>{{$collage->name}}</td>
                    @can('role-edit')
                    <td> <a  href="" data-toggle="modal" data-target="#edit{{$collage->id}}" class="btn btn-warning mr-3 ml-2">
                                       <i class="fa fa-edit fa-2x"></i>
                                       </a>
                                       
                                       
                                       

<div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="edit{{$collage->id}}">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">  تعديل بيانات الكلية {{$collage->name}}</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                    {!! Form::open(['action' => ['App\Http\Controllers\admin\CollageController@update',$collage->id], 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                    
                    <div class="form-group">

            {{Form::label('name','اسم الكلية')}}
            {{Form::text('name', $collage->name, ['class' => 'form-control', 'placeholder' => 'الاسم'])}}
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
              @endcan
              @can('role-delete')
              <td>
                    {!!Form::open(['action' => ['App\Http\Controllers\admin\CollageController@destroy',$collage->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                    {{Form::hidden('_method','DELETE')}}
                       <button class ="btn btn-danger mr-3 ml-3" type="submit"><i class="fa fa-md fa-trash"></i>
                       </button>
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






<!--  data-backdrop="static" id="add" -->


<div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="add">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">  اضافة كلية جديدة</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                    {!! Form::open(['action' => 'App\Http\Controllers\admin\CollageController@store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                   
        <div class="form-group">
            {{Form::label('name','اسم الكلية')}}
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