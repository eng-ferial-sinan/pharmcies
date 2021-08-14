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
                    <th>#</th>
                    <th>#</th>
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
                  <td>{{$medicine->id}}</td>
                  <td><img src="{{$medicine->image}}" height="80" width="75"></td>
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
                <div class="modal-dialog modal-xl" >
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
    
              <div class="form-group">
                {{Form::label('traite','الفوائد')}}
                {{Form::textarea('traite', $medicine->traite, [ 'rows'=>'4','class' => 'form-control', 'placeholder' => 'الفوائد'])}}
                </div>
                <div class="form-group">
                  {{Form::label('demerites','العيوب')}}
                  {{Form::textarea('demerites', $medicine->demerites, [ 'rows'=>'4','class' => 'form-control', 'placeholder' => 'العيوب'])}}
                </div>
                <div class="form-group">
                  {{Form::label('relics','الاثار الجانبية')}}
                  {{Form::textarea('relics', $medicine->relics, [ 'rows'=>'4','class' => 'form-control', 'placeholder' => 'الاثار الجانبية'])}}
                </div>
                              
            <div class="form-group">
              {{Form::label('category_id','الصنف')}}
              {!! Form::select('category_id', $categories2,$medicine->category_id, array('class' => 'form-control')) !!}
            </div>

            <div class="form-group">
              {{Form::label('price',' السعر')}}
              {{Form::number('price',$medicine->price, ['class' => 'form-control', 'placeholder' => 'الاسم','required'=>true])}}
           </div>
            <div class="form-group">
              {{Form::label('production_date','تاريخ الانتاج')}}
              {{Form::date('production_date', $medicine->production_date, ['class' => 'form-control','required'=>true])}}
          </div>
          <div class="form-group">
            {{Form::label('expiry_date','تاريخ الانتهاء')}}
            {{Form::date('expiry_date',$medicine->expiry_date, ['class' => 'form-control','required'=>true])}}
        </div>
        <div class="form-group">
          <img src="{{$medicine->image}}" class="img-rounded" height="50" width="70" alt="{{$medicine->name}}">
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

<div class="modal fade" id="add">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">  اضافة دواء جديد</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action' => 'App\Http\Controllers\MedicineController@store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
       
<div class="form-group">
{{Form::label('name','اسم الدواء')}}
{{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'الاسم','required'=>true])}}
</div>
<div class="form-group">
{{Form::label('traite','الفوائد')}}
{{Form::textarea('traite', '', [ 'rows'=>'4','class' => 'form-control', 'placeholder' => 'الفوائد'])}}
</div>
<div class="form-group">
{{Form::label('demerites','العيوب')}}
{{Form::textarea('demerites', '', [ 'rows'=>'4','class' => 'form-control', 'placeholder' => 'العيوب'])}}
</div>
<div class="form-group">
{{Form::label('relics','الاثار الجانبية')}}
{{Form::textarea('relics', '', [ 'rows'=>'4','class' => 'form-control', 'placeholder' => 'الاثار الجانبية'])}}
</div>
@php
// $categories=\App\Models\category::pluck('name','id')->all();
$categories=\App\Models\category::all();
@endphp


<div class="form-group">
{{Form::label('category_id','الصنف ')}}
<select name="category_id" class="select2 form-control" required >
@foreach ($categories as $item)
<option value="{{$item->id}}">
   {{ $item->name}}
</option>
@endforeach

</select>
{{-- {!! Form::select('category_id', $categories,null, array('class' => 'form-control')) !!} --}}
</div>

<div class="form-group">
{{Form::label('price',' السعر')}}
{{Form::number('price', '', ['class' => 'form-control', 'placeholder' => 'الاسم','required'=>true])}}
</div>
<div class="form-group">
{{Form::label('production_date','تاريخ الانتاج')}}
{{Form::date('production_date', '', ['class' => 'form-control','required'=>true])}}
</div>
<div class="form-group">
{{Form::label('expiry_date','تاريخ الانتهاء')}}
{{Form::date('expiry_date', '', ['class' => 'form-control','required'=>true])}}
</div>

<div class="form-group">
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


            
@endsection