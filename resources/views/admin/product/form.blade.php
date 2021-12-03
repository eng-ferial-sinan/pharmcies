@extends('admin.vadmin.lay')

@section('head')   /
بيانات   المنتجات

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
        <form method="post" action="@if ($item->id == null) {{ route('product.store') }} @else {{ route('product.update', ['product' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif       
        <div class="form-group">
        {{Form::label('name','اسم المنتج')}}
        {{Form::text('name', $item->name , ['class' => 'form-control', 'placeholder' => 'الاسم','required'=>true])}}
        </div>
        @php
        $categories=\App\Models\Category::all();
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
          {{Form::label('sort',' الترتيب')}}
          {{Form::number('sort',$item->sort, ['class' => 'form-control', 'placeholder' => 'الترتيب','required'=>true])}}
          </div>

        <div class="form-group">
          <img src="{{$item->image}}" class="img-rounded" height="50" width="70" alt="{{$item->name}}">
           <br/>
            {{Form::label('image','صورة معبرة')}}
             {{Form::file('image')}}
         </div>
                 </div>
              <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">حفظ </button>
                <a href="\admin\product" class="btn btn-default" data-dismiss="modal">الغاء</a>
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
