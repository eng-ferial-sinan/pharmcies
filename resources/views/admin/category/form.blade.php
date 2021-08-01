@extends('admin.vadmin.admin')

@section('head')   /
بيانات   
   الاصناف

@endsection

@section('content')

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
  {{$item->name }}  </div>

  @endif
    
                    </h3>

        <form method="post" action="@if ($item->id == null) {{ route('category.store') }} @else {{ route('category.update', ['category' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif

       <div class="form-group">
            {{Form::label('title','الصنف')}}
            {{Form::text('name', $item->name, ['class' => 'form-control', 'placeholder' => '','required'=>true])}}
        </div>

        

        
        

        
       
    {{Form::submit('حفظ',['class'=>'btn btn-primary'])}}    
    {!! Form::close() !!}   
   
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
@section('script')
<script src="/app.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.dropdown.css">
<script src="/js/jquery.dropdown.js"></script>
<script>

    $('.dropdown-sin-1').dropdown({
      readOnly: true,
      input: '<input type="text" maxLength="20" placeholder="Search">'
    });

  
  </script>
      @endsection
