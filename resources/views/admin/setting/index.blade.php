@extends('admin.vadmin.lay')
@section('title') /
 <span class="badge badge-info">

     تعديل  البيانات الاساسية للموقع :
</span>
@endsection
@section('content')
<!--link rel="stylesheet" href="/date/css/style.css"-->

 
  <div class="md-form text-right text-black col-md-12 card p-2 m-1">
    <h5 class="btn-info p-2">
     تعديل  البيانات الاساسية للموقع :
</h5>
 
  <form action="/settings" method="post" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}
             
            <div class="form-row">
                    <div class="col-md-6">
                        <label for="from" class="font-weight-bold text-right js">     اسم الشركة     </label>
                        <input type="text" name="nameAr" id="nameAr" class="form-control" required  value="{{$info->nameAr}}">
                        <input type="hidden" name="num" id="num" class="form-control" required  value="{{$info->id}}">
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                                <label for="from" class="font-weight-bold text-right js">     company Name   </label>
                            <input type="text" name="nameEn" id="nameEn" class="form-control"  value="{{$info->nameEn}}">
                        </div> 
                    </div>
            </div> 
            <div class="form-row">
                <label for="address" class="font-weight-bold text-right js"> العنوان      </label>
                <textarea name="address" id="address" class="form-control">{{$info->address}}
                </textarea>   
            </div>
            
        <div class="form-row">
                <div class="col-md-6">
                    <label for="from" class="font-weight-bold text-right js">    تلفون    </label>
                    <input type="text" name="phone" id="phone" class="form-control" required  value="{{$info->phone}}">
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                            <label for="from" class="font-weight-bold text-right js">     البريد الإلكتروني  email   </label>
                        <input type="email" name="email" id="e_name" class="form-control"  value="{{$info->email}}">
                    </div> 
                </div>
        </div> 
        <div class="form-row">
            <div class="col-md-6">
                <label for="from" class="font-weight-bold text-right js">    فيس بوك    </label>
                <input type="text" name="facebook" id="facebook" class="form-control"   value="{{$info->facebook}}">
            </div> 
            <div class="col-md-6">
                <div class="form-group">
                        <label for="from" class="font-weight-bold text-right js">   حساب تويتر     </label>
                    <input type="twitter" name="twitter" id="e_name" class="form-control"  value="{{$info->twitter}}">
                </div> 
            </div>
       </div> 
       <div class="form-row">
                    <div class="col-md-6">
                        <label for="from" class="font-weight-bold text-right js">    انستجرام    </label>
                        <input type="text" name="instagram" id="instagram" class="form-control"   value="{{$info->instagram}}">
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                                <label for="from" class="font-weight-bold text-right js">  حساب جوجل بلاس  </label>
                            <input type="google_plus" name="google_plus" id="e_name" class="form-control"  value="{{$info->google_plus}}">
                        </div> 
                    </div>
        </div>

             <div class="form-group">
            <label for="asolgan" class="font-weight-bold text-right js"> شعار الشركة    </label>
                <img src="{{$info->image}}" class="img-rounded" height="50" width="70" alt="{{$info->nameAr}}">
                 <br/>
                  {{Form::label('image','صورة معبرة')}}
                   {{Form::file('image')}}
               </div>

           
           @can('edit settings')
           <div class="form-group">
            {{Form::submit('حفظ التعديلات',['class'=>'btn btn-primary'])}} 
            </div>   
           @endcan
           
            </form>
          
</div>
     
 
   @endsection

   @section('script')
   
   <!--script  src="/date/js/index.js"></script-->
   @endsection