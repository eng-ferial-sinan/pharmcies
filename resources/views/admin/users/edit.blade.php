@extends('admin.vadmin.lay')

@section('content')
@php
function roleName1($name)
 {
      
switch($name)
{
 case "medicine-list": $name = "عرض انواع ادوية"; break;
 case "medicine-create": $name = "انشاء دواء جديد";break;
 case "medicine-edit": $name = "تعديل دواء   ";break;
 case "medicine-delete": $name = "حذف دواء";break;
 case "user-list": $name = "عرض  المستخدمين"; break;
 case "user-create": $name = "انشاء مستخدم جديد";break;
 case "user-edit": $name = "تعديل  المستخدم  ";break;
 case "user-delete": $name = "حذف المستخدم";break;
 case "Pharmacy-list": $name = "عرض الصيدلايات "; break;
 case "Pharmacy-create": $name = "انشاء  صيدلية جديد";break;
 case "Pharmacy-edit": $name = "تعديل صيدلية    ";break;
 case "Pharmacy-delete": $name = "حذف صيدلية";break;
 case "category-list": $name = "عرض الاصناف "; break;
 case "category-create": $name = "انشاء صنف جديد ";break;
 case "category-edit": $name = "تعديل الصنف   ";break;
 case "category-delete": $name = "حذف الصنف";break;
 case "report-list": $name = "عرض  التقارير"; break;
 case "report-create": $name = "انشاء تقرير ";break;
 case "report-edit": $name = "تعديل  تقرير  ";break;
 case "report-delete": $name = "حذف تقرير";break;
 case "order-list": $name = "عرض  الطلبيات"; break;
 case "order-create": $name = "انشاء طلبية ";break;
 case "order-edit": $name = "تعديل  طلبية  ";break;
 case "order-delete": $name = "حذف طلبية";break;
    
}

     return  $name;

 }
@endphp



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
