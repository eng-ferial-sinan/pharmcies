@extends('admin.vadmin.lay')

@section('head')   @endsection
 @section('content')   

 @php
   function roleName1($name)
    {
         
switch($name)
{
    case "medicine-list": $name = "عرض انواع المستخدمين"; break;
    case "medicine-create": $name = "انشاء نوع جديد";break;
    case "medicine-edit": $name = "تعديل نوع المستخدم  ";break;
    case "medicine-delete": $name = "حذف نوع";break;
    case "user-list": $name = "عرض  المستخدمين"; break;
    case "user-create": $name = "انشاء مستخدم جديد";break;
    case "user-edit": $name = "تعديل  المستخدم  ";break;
    case "user-delete": $name = "حذف المستخدم";break;
    case "Pharmacy-list": $name = "عرض الصيدلايات "; break;
    case "Pharmacy-create": $name = "انشاء  صيدلية جديد";break;
    case "Pharmacy-edit": $name = "تعديل صيدلية    ";break;
    case "Pharmacy-delete": $name = "حذف صيدلية";break;
    case "category-list": $name = "عرض انواع المستخدمين"; break;
    case "category-create": $name = "انشاء نوع جديد";break;
    case "category-edit": $name = "تعديل نوع المستخدم  ";break;
    case "category-delete": $name = "حذف نوع";break;
    case "report-list": $name = "عرض  المستخدمين"; break;
    case "report-create": $name = "انشاء مستخدم جديد";break;
    case "report-edit": $name = "تعديل  المستخدم  ";break;
    case "report-delete": $name = "حذف المستخدم";break;
    case "order-list": $name = "عرض  المستخدمين"; break;
    case "order-create": $name = "انشاء مستخدم جديد";break;
    case "order-edit": $name = "تعديل  المستخدم  ";break;
    case "order-delete": $name = "حذف المستخدم";break;
       
}

        return  $name;
   
    }
@endphp


<div class="container">
    <div class="md-form text-right text-black col-md-12 card p-2 m-1">
        {!! Form::open(['action' => 'App\Http\Controllers\UserController@store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
        {{ csrf_field() }}
        
        <div class="col-md-6">
            <h6>قم بإختيار 
            نوع المستخدم     </h6>
            </div>
            <div class="col-md-4">
                {{-- {!! Form::select('roles', $roles,[], array('class' => 'form-control','multiple')) !!} --}}
                {{Form::select('user_type',['1'=>'1','2'=>'2','3'=>'3'],'', ['class' => 'custom-select', 'placeholder' => 'اختر نوع المستخدم','required'=>true])}}
            
            </div>
    
    <div class="md-form text-right text-black col-md-12 card p-2 m-1">
        <h5 class="btn-info p-2">
           بيانات الاساسية :
    </h5>     
            <div class="form-row" style="align-items: flex-end;">
                <div class="form-group col-md-4">
                <i class="fa fa-user-o prefix text-right font-weight-bold"></i>
                <input type="text" name="name" id="name" class="form-control" required placeholder="اسم " >
                </div> 
                <div class="form-group col-md-4">
                    <i class="fa fa-phone prefix text-right font-weight-bold"></i>
                <input type="text" name="phone" id="phone" class="form-control" required placeholder="رقم التلفون " >
                </div> 


                <div class="form-group col-md-4">
                    {{Form::label('permission','الصلاحيات')}}
                    <select name="permission[]" class="select2 w-100" multiple >
                    @foreach ($permission as $item)
                    <option value="{{$item->id}}">
                       {{ roleName1($item->name)}}
                    </option>
                    @endforeach

                    </select>
                    {{-- {{Form::select('',$permission,null, [ 'multiple'=>"multiple" ,'class' => 'form-control select2'])}} --}}
                  </div>
                
        </div> 
       
        </div> 
    
    
<div class="md-form text-right text-black col-md-12 card p-2 m-1">
    <h5 class="btn-info p-2">
    بيانات حساب مدير النظام :
</h5>     
        <div class="form-row">
            <div class="col-md-4">
                <i class="fa fa-envelope-o prefix text-right font-weight-bold"></i>
                <input type="text" id="email" name="email" class="form-control  text-right js pr-5" value="{{ old('email') }}"   placeholder=" الاميل Gmail  " >
                        @if ($errors->has('email'))
                        <span class="help-block error_reporting">
                            <strong class="red-text">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div> 
                
            <div class="col-md-4">
                <i class="fa fa-lock prefix text-right font-weight-bold"></i>
                <input type="password" id="password1" name="password" class="form-control  text-right js pr-5"   value="{{ old('password') }}"   placeholder="كلمة السر  " >
                        @if ($errors->has('password'))
                        <span class="help-block error_reporting">
                            <strong class="red-text">{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div> 
            <div class="col-md-4">
                <i class="fa fa-lock prefix text-right font-weight-bold"></i>            
                <input type="password" id="password2"  name="password_confirmation" class="form-control  text-right js pr-5"  value="{{ old('password_confirmation') }}"    placeholder="تاكيد كلمة السر  " >
                @if ($errors->has('password'))
                        <span class="help-block error_reporting">
                            <strong class="red-text">{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div> 
                
               </div> 
            
</div>


            <div class="text-center py-4 mt-3">
                <button class="btn btn-success  " type="submit">تسجيل<i class="fa fa-user-circle-o ml-2"></i></button>
                </div>
             
   
    </div> 
</div> 
     
    
    

        
    </form>
                  
                            
    </div>


    
 </div>
 
    <!--<div id="sign-in-status"></div>
    <div id="sign-in"></div>
    <div id="account-details"></div>
    -->
 

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