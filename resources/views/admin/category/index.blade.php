@extends('admin.vadmin.lay')

@section('title')   /
بيانات   
    الاصناف

@endsection


@section('content')

<div class="container"> 


    <div class="row">
        <div class="col-md-12  " style="text-align: center;">
          @can('add category')
          <a href="" data-toggle="modal" data-target="#add" class="btn btn-info float-left">
                    <i class="fa fa-plus fa-2x"></i> اضافة صنف
                </a>
            @endcan

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
                    <th>#</th>
                    <th>الصنف</th>
                    @can('edit category')
                    <th>-</th>
                    @endcan
                    @can('delete category')
                    <th>-</th>
                    @endcan
                </tr>
                </thead>
                <tbody>  
                    @foreach($categorys as $category)
                    <tr>
                    <td>{{$category->id}} </td>
                    <td><img src="{{$category->image}}" height="80" width="75"></td>

                    <td>{{$category->name}}</a></td>

            
                    @can('edit category')
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
<div class="form-group">
  {{Form::label('sort',' الترتيب')}}
  {{Form::number('sort',$category->sort, ['class' => 'form-control', 'placeholder' => 'الترتيب','required'=>true])}}
  </div>

<div class="form-group">
  <img src="{{$category->image}}" class="img-rounded" height="50" width="70" alt="{{$category->name}}">
   <br/>
    {{Form::label('image','صورة معبرة')}}
     {{Form::file('image')}}
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
                    
                
                    @can('delete category')
                    <td>

 
                        {!!Form::open(['action' => ['App\Http\Controllers\CategoryController@destroy',$category->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
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
