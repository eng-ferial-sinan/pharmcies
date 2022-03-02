@extends('admin.vadmin.lay')

@section('head')   /
بيانات   الخدمةات

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
        <form method="post" action="@if ($item->id == null) {{ route('service.store') }} @else {{ route('service.update', ['service' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif       
        <div class="form-group">
        {{Form::label('name','اسم الخدمة')}}
        {{Form::text('name', $item->name , ['class' => 'form-control', 'placeholder' => 'الاسم','required'=>true])}}
        </div>
        <div class="form-group">
          {{Form::label('desc',' الوصف')}}
          {{Form::text('desc', $item->desc , ['class' => 'form-control', 'placeholder' => 'الوصف','required'=>true])}}
          </div>

        @php
        $categories=\App\Models\Salon::all();
        @endphp
        
        
        <div class="form-group">
        {{Form::label('salon_id','الصالون ')}}
        <select name="salon_id" class="select2 form-control" required  >
        @foreach ($categories as $salon)
        <option value="{{$salon->id}}"  @if ($salon->id == $item->salon_id) selected @endif >
           {{ $salon->name}}
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
                <a href="\admin\service" class="btn btn-default" data-dismiss="modal">الغاء</a>
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
