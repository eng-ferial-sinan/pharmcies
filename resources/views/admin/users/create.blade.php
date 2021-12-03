@extends('admin.vadmin.lay')

@section('head')   @endsection
 @section('content')   

 
<div class="container">
    <div class="tile ">
    <div class="md-form text-right text-black col-md-12 card p-2 m-1">
        {!! Form::open(['action' => 'App\Http\Controllers\UserController@store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
        {{ csrf_field() }}
        
        <div class="col-md-6">
            <h6>قم بإختيار 
            نوع المستخدم     </h6>
            </div>
            <div class="col-md-4">
                {{-- {!! Form::select('roles', $roles,[], array('class' => 'form-control','multiple')) !!} --}}
                {{Form::select('roles', $roles,'', ['class' => 'custom-select', 'placeholder' => 'اختر نوع المستخدم','required'=>true])}}
            
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