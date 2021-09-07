@extends('admin.vadmin.lay')

@section('title')   /
بيانات   
    الاصناف

@endsection


@section('content')

<div class="container"> 


    <div class="row">
        <div class="col-md-12  " style="text-align: center;">
                @if (auth()->user()->hasPermission('category-create'))
                <a href="" data-toggle="modal" data-target="#add" class="btn btn-info float-left">
                    <i class="fa fa-plus fa-2x"></i> اضافة صنف
                </a>
            @endif

    </div>
</div>

@if(count($categorys)>0)
<div class="row">
 <div class="col-md-12">
   <div class="tile">
     <div class="tile-body">
       <div class="table-responsive">
       <table class="table table-hover table-bordered " id="sampleTable">
                        <thead>
                       <tr>
                    <th>#</th>
                    <th>الصنف</th>
                    <th>-</th>
                    <th>-</th>
                </tr>
                </thead>
                <tbody>  
                    @foreach($categorys as $category)
                    <tr>
                    <td>{{$category->id}} </td>
                    <td>{{$category->name}}</a></td>

                    {{-- @if (auth()->user()->hasPermission('category-edit')) --}}
            
                    {{-- @can('category-edit') --}}
                    <td> <a  href="" data-toggle="modal" data-target="#edit{{$category->id}}" class="btn btn-warning mr-3 ml-2">
                        <i class="fa fa-edit fa-2x"></i>
                        </a>
                        
                        
                        

<div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="edit{{$category->id}}">
 <div class="modal-dialog modal-xl" >
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title">  تعديل بيانات الصنف {{$category->name}}</h5>
       <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
     </div>
     <div class="modal-body">
     {!! Form::open(['action' => ['App\Http\Controllers\CategoryController@update',$category->id], 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
     
<div class="form-group">
{{Form::label('name','اسم الصنف')}}
{{Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'الاسم'])}}
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
                    {{-- @endif --}}
                     
                    {{-- @endcan --}}
                    
                    {{-- @if (auth()->user()->hasPermission('category-delete')) --}}
                
                    {{-- @can('category-delete') --}}
                    <td>

 
                        {!!Form::open(['action' => ['App\Http\Controllers\CategoryController@destroy',$category->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('الحذف',['class'=>'btn btn-danger'])}}
                        {!!Form::close()!!}
                       
                        
                    </td>
                    {{-- @endif --}}

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
    
<div class="modal fade" id="add">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">  اضافة صنف  جديد</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {!! Form::open(['action' => 'App\Http\Controllers\CategoryController@store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
         
  <div class="form-group">
  {{Form::label('name','اسم الصنف ')}}
  {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'الاسم','required'=>true])}}
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
