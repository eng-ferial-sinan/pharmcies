@extends('admin.vadmin.lay')

@section('content')



<div class="container dir_rtl afrahright">
  <div class="tile ">

    <h3>تحرير   
    بيانات   
{{$user->name }}

                    </h3>
   {!! Form::open(['action' => ['App\Http\Controllers\UserController@update',$user->id], 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
    
       <div class="form-group">
            {{Form::label('title','الاسم')}}
            {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => '','required'=>true])}}
        </div>
 
        <div class="form-group">
            {{Form::label('title','اسم المستخدم')}}
            {{Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => '','readonly'=>true])}}
        </div>

 
        <div class="form-group">
            {{Form::label('title',' الجديدة ادخل كلمة المرور')}}
            {{Form::text('password', '', ['placeholder' => ' كلمة المرور','class' => 'form-control','required'=>true])}}
        </div>
        <div class="form-group">
            {{Form::label('title','  تاكيد كلمة المرور')}}
            {!! Form::text('confirm-password','', array('placeholder' => ' تاكيد كلمة المرور','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
          {{Form::label('title','الصلاحيات')}}
          {{-- {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!} --}}
          {{Form::select('roles', $roles,$userRole, ['class' => 'custom-select', 'placeholder' => 'اختر نوع المستخدم','required'=>true])}}

      </div>      
     
    
       
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('تعديل',['class'=>'btn btn-primary'])}}    
    {!! Form::close() !!}   
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
@section('script')
    <script>
    
     
    $('.select2').select2();  
                       
    
      $('.counter_id').select2({
            width: '100%',
            dropdownParent: $("#add")
        })
       
           
       </script>
    
    <!--script  src="/date/js/index.js"></script-->
    @endsection
