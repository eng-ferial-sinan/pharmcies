@extends('admin.vadmin.lay')

@section('head')  

@endsection
@section('title') /
 <span class="badge badge-info">
الصفحة الشخصية
للعضو  : 
{{$user->email}}
</span>
@endsection
@section('content')
<!--link rel="stylesheet" href="/date/css/style.css"-->
 
@php
   function roleName1($name)
    {
         
switch($name)
{
    case "admin": $name = "مشرف الموقع"; break;
    case "delegate": $name = "مندوب  ";break;
  
}

        return  $name;
   
    }
@endphp

      
        <div class="row">
        <div class="col-md-8">
       
               <div class="tile user-settings">
                <h4 class="line-head">تعديل البيانات الشخصية</h4>
                <form action="/admin/profile/updated" method="POST" class="form-horizontal">
 {{ csrf_field() }}
                  <div class="row mb-4">
                    <div class="col-md-8">
                      <label>الاسم</label>
                      <input class="form-control" type="text" name="name" value="{{$user->name}}" required>
                    </div>
                
                  </div>
                  <div class="row">
                    
                    <div class="col-md-8 mb-4">
                      <label>كلمةالسر</label>
                      <input type="password"  name="password" class="form-control  text-right js pr-5"    required  placeholder="كلمة السر  " >
                      @if ($errors->has('password'))
                      <span class="help-block error_reporting">
                          <strong class="red-text">{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                  </div>
                    <div class="clearfix"></div>

                    <div class="col-md-8 mb-4">
                      <label>تاكيد كلمةالسر </label>
                      <input type="password"   name="password_confirmation" class="form-control  text-right js pr-5"    required  placeholder="تاكيد كلمة السر  " >
                      @if ($errors->has('password'))
                              <span class="help-block error_reporting">
                                  <strong class="red-text">{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                                 
                        </div>

                    <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>Mobile No  رقم الجوال</label>
                      <input class="form-control" type="text" name="phone" value="{{$user->phone}}" required>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>user name اسم المستخدم</label>
                      <input class="form-control" type="text" readonly value="{{$user->email}}">
                    </div>
                  </div>
                  <div class="row mb-10">
                    <div class="col-md-12">
                      <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> حفظ </button>
                    </div>
                  </div>
                </form>

            </div>
         </div>
         <div class="col-md-4 tile user-settings">
         <div class="info"><img class="user-img img-fluid img-responsive" src="{{$user->url? $user->url:'/img/logo.png'}}">
              <h4>{{$user->name}}</h4>
              <p> @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
               <a class="badge-success btn btn-default">{{ $v }}</a>
                @endforeach
               @endif  </p>
            </div>

            <h4 class="line-head">تعديل الصورة الشخصية</h4>
                   <div class="row mb-4">
                    <div class="col-md-8">
                    <form action="/admin/profile/updated/saveimage" method="POST" class="form-horizontal" enctype="multipart/form-data">
 {{ csrf_field() }}
                      <label>رفع صورة </label>
                      <input class="form-control" type="file" name= "myimg">
                    </div> 
                    <div class="col-md-4">
                       <input class="btn btn-primary" type="submit" value="رفع">
                    </div>
                  </div>
</form>
 
</div>
</div>
         
 











   @endsection

   @section('script')
   <!--script  src="/date/js/index.js"></script-->
   @endsection