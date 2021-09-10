@extends('admin.vadmin.lay')

@section('head')   /
بيانات   الادوية

@endsection

@section('content')

<div class="tile ">

<div class="panel panel-default">
    @if ($item->id == null)
    <div class="panel-heading">
    اضافة   
    بيانات   
  </div>
  @else 
  <div class="panel-heading">
    تحرير   
    بيانات   
  {{$item->name }}  
</div>

  @endif
    
  <div class="panel-body">     
        <form method="post" action="@if ($item->id == null) {{ route('medicine.store') }} @else {{ route('medicine.update', ['medicine' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif       
        <div class="form-group">
        {{Form::label('name','اسم الدواء')}}
        {{Form::text('name', $item->name , ['class' => 'form-control', 'placeholder' => 'الاسم','required'=>true])}}
        </div>
        <div class="form-group">
        {{Form::label('traite','الفوائد')}}
        {{Form::textarea('traite', $item->traite, [ 'rows'=>'4','class' => 'form-control', 'placeholder' => 'الفوائد'])}}
        </div>
        <div class="form-group">
        {{Form::label('demerites','العيوب')}}
        {{Form::textarea('demerites', $item->demerites, [ 'rows'=>'4','class' => 'form-control', 'placeholder' => 'العيوب'])}}
        </div>
        <div class="form-group">
        {{Form::label('relics','الاثار الجانبية')}}
        {{Form::textarea('relics',$item->relics, [ 'rows'=>'4','class' => 'form-control', 'placeholder' => 'الاثار الجانبية'])}}
        </div>
        @php
        $categories=\App\Models\category::all();
        @endphp
        
        
        <div class="form-group">
        {{Form::label('category_id','الصنف ')}}
        <select name="category_id" class="select2 form-control" required  >
        @foreach ($categories as $category)
        <option value="{{$category->id}}"  @if ($category->id == $item->category_id) selected @endif >
           {{ $category->name}}
        </option>
        @endforeach
        
        </select>
        {{-- {!! Form::select('category_id', $categories,null, array('class' => 'form-control')) !!} --}}
        </div>
        
        <div class="form-group">
        {{Form::label('price',' السعر')}}
        {{Form::number('price',$item->price, ['class' => 'form-control', 'placeholder' => 'السعر','required'=>true])}}
        </div>
        <div class="form-group">
        {{Form::label('production_date','تاريخ الانتاج')}}
        {{Form::date('production_date',$item->production_date, ['class' => 'form-control','required'=>true])}}
        </div>
        <div class="form-group">
        {{Form::label('expiry_date','تاريخ الانتهاء')}}
        {{Form::date('expiry_date',$item->expiry_date, ['class' => 'form-control','required'=>true])}}
        </div>
        <div class="form-group">
          <img src="{{$item->image}}" class="img-rounded" height="50" width="70" alt="{{$item->name}}">
           <br/>
            {{Form::label('image','صورة معبرة')}}
             {{Form::file('image')}}
         </div>
        {{-- <div class="form-group">
            {{Form::label('image','صورة معبرة')}}
             {{Form::file('image')}}
         </div> --}}
                 </div>
              <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">حفظ </button>
                <a href="\medicine" class="btn btn-default" data-dismiss="modal">الغاء</a>
              </div>
        </form>
      </div>
</div>
    <script>
            function ConfirmDelete()
            {
            var x = confirm("هل تريد فعلاً الحذف؟");
            if (x)
              return true;
            else
              return false;
            }
          
    </script>
    
      @endsection
