@extends('admin.vadmin.lay')

@section('title')   /
بيانات   
    promotion

@endsection


@section('content')

<div class="container"> 


    <div class="row">
        <div class="col-md-12  " style="text-align: center;">
          @can('add promotion')
          <a href="" data-toggle="modal" data-target="#add" class="btn btn-info float-left">
                    <i class="fa fa-plus fa-2x"></i> اضافة promotion
                </a>
            @endcan

    </div>
</div>

@php
$categories=\App\Models\Salon::all();
@endphp

@if(count($promotions)>0)
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
                    <th>الترتيب</th>
                    <th>الصالون</th>
                    @can('edit promotion')
                    <th>-</th>
                    @endcan
                    @can('delete promotion')
                    <th>-</th>
                    @endcan
                </tr>
                </thead>
                <tbody>  
                    @foreach($promotions as $promotion)
                    <tr>
                    <td>{{$promotion->id}} </td>
                    <td><img src="{{$promotion->image}}" height="80" width="75"></td>

                    <td>{{$promotion->sort}}</a></td>
                    <td>{{$promotion->salon?$promotion->salon->name:''}}</td>

            
                    @can('edit promotion')
                    <td> <a  href="" data-toggle="modal" data-target="#edit{{$promotion->id}}" class="btn btn-warning mr-3 ml-2">
                        <i class="fa fa-edit fa-2x"></i>
                        </a>
                        
                        
                        

<div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="edit{{$promotion->id}}">
 <div class="modal-dialog modal-xl" >
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title">  تعديل بيانات promotion {{$promotion->id}}</h5>
       <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
     </div>
     <div class="modal-body">
     {!! Form::open(['action' => ['App\Http\Controllers\PromotionController@update',$promotion->id], 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
     

     <div class="form-group">
      {{Form::label('salon_id','الصالون ')}}
      <select name="salon_id" class="select2 form-control" required  >
      @foreach ($categories as $salon)
      <option value="{{$salon->id}}"  @if ($salon->id == $promotion->salon_id) selected @endif >
         {{ $salon->name}}
      </option>
      @endforeach
      
      </select>
     
      <div class="form-group">
        {{Form::label('sort',' الترتيب')}}
        {{Form::number('sort',$promotion->sort, ['class' => 'form-control', 'placeholder' => 'الترتيب','required'=>true])}}
        </div>

  

<div class="form-group">
  <img src="{{$promotion->image}}" class="img-rounded" height="50" width="70" alt="{{$promotion->id}}">
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
                    
                
                    @can('delete promotion')
                    <td>

 
                        {!!Form::open(['action' => ['App\Http\Controllers\PromotionController@destroy',$promotion->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
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
          <h5 class="modal-title">  اضافة promotion  جديد</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {!! Form::open(['action' => 'App\Http\Controllers\PromotionController@store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
         
          <div class="form-group">
            {{Form::label('salon_id','الصالون ')}}
            <select name="salon_id" class="select2 form-control" required  >
            @foreach ($categories as $salon)
            <option value="{{$salon->id}}"   >
               {{ $salon->name}}
            </option>
            @endforeach
            
            </select>
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
