@extends('admin.vadmin.lay')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
@section('content')
<style>
#loading{
display:none;
margin-left:145px
}
 
</style>
<div class="container js pt-2 mt-2">
<div class="row">
<div class="col-md-12">
    <h3 class="text-center">
اضافة  طلب  جديد        </h3>
<h3 class="text-left" >
    <a href="/admin/anyorder" class="btn btn-light custom-btn">الغاء</a>
   </h3>
    </div>
</div>
<div class="row">

<div class="col-md-6">
{!! Form::open(['action' => 'admin\orderController@store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
<!-- Card -->
<div class="card mx-xl-1 js text-black">

<!-- Card body -->
<div class="card-body js text-right text-black">

    <!-- Default form subscription -->
    
 
       
                 <div class="md-form text-right mb-3 ">
                    <label for="" class="font-weight-bold text-right js">    اسم الزبون   </label>
                    {{Form::text('name','', ['class' => 'form-control', 'placeholder' => 'اسم الزبون','required'=>'required'])}}
                </div>
                <div class="md-form text-right mb-3 ">
                    <label for="" class="font-weight-bold text-right js">    رقم التلفون   </label>
                    {{Form::text('phone','', ['class' => 'form-control', 'placeholder' => ' رقم التلفون','required'=>'required'])}}
                </div>
      
        <div class="form-inline md-form text-right mb-3 ">
          <label for="" class="font-weight-bold text-right js">  اختار عناون الاستلام</label> 
          <select name="address_id" id="" class="custom-select js-example-basic-single" required>
              @foreach ($address as $item)
                  <option value="{{$item->id}}">
                {{$item->name}} - {{$item->desc}}</option>
              @endforeach
        </select>                   
         {{-- {{Form::select('address_id', $address,0, ['class' => 'custom-select', 'placeholder' => 'اختر العناون','required'=>'required'])}} --}}
        </div>
        <div class="md-form text-right mb-3 ">
            <label for="" class="font-weight-bold text-right js">    وصف العنوان   </label>
            {{Form::text('desc_address','', ['class' => 'form-control', 'placeholder' => ' وصف العنوان','required'=>'required'])}}
        </div>
               
     <hr class="hr-dark">
     <div class="md-form text-right mb-3 ">
      <label for="" class="font-weight-bold text-right js">   وصف الطلبية        </label>
         {{Form::textarea('desc', '', ['id' => 'article-ckeditor17','class' => 'form-control', 'placeholder' => '','rows'=>'3'])}}
       </div>
     </div>
    </div> 
  </div> <!-- end col-->            

 <div class="col-md-6">
 <!-- Card -->
<div class="card mx-xl-1 text-black">

<!-- Card body -->
<div class="card-body  text-right text-black">
 
    <hr class="hr-dark">
    <div class="form-group">
        {{Form::label('store_id','المحل')}}
        {{Form::select('store_id', $store,0, ['class' => 'custom-select js-example-basic-single','id'=>'store_id', 'placeholder' => 'اختر المركز','required'=>'required'])}}
    </div>

    <div class="form-inline md-form text-right mb-3 " id="address_id2">
        <label for="" class="font-weight-bold text-right js">  اختار عناون التسليم</label> 
        <select name="address_id2" id="address_select" class="custom-select js-example-basic-single w-100" >
            @foreach ($address as $item)
                <option value="{{$item->id}}">
              {{$item->name}} - {{$item->desc}}</option>
            @endforeach
      </select>                   
      </div>
      <div class="md-form text-right mb-3 d-none" id="desc_address2">
          <label for="" class="font-weight-bold text-right js">    وصف عنوان التسليم   </label>
          {{Form::text('desc_address2','', ['class' => 'form-control','id'=>'text_desc_address', 'placeholder' => ' وصف العنوان'])}}
      </div>


    <div class="form-group">
        {{Form::label('shippingType','مدة التوصيل')}}
        {{Form::text('shippingType', '', ['class' => 'form-control', 'placeholder' => 'بعد ساعة','required'=>true])}}
    </div>
    <div class="form-group">
        {{Form::label('price',' سعر الطلبية التقريبي')}}
        {{Form::text('price', '', ['class' => 'form-control', 'placeholder' => '1000 ','required'=>true])}}
    </div>
    <div class="form-group">
        {{Form::label('currency_id','العملة')}}
        {{Form::select('currency_id', $currency,1, ['class' => 'custom-select js-example-basic-single', 'placeholder' => 'اختر العملة','required'=>'required'])}}
    </div>

</div>
<!-- Card body -->
 
<!-- Card -->
                  
 
</div>

 </div> <!-- end col--> 
</div>
</div>
<div class="container text-right js pt-2 mt-2 card">  
    {{Form::submit('حــــفـــــظ',['class'=>'btn btn-primary'])}}    
    {!! Form::close() !!}   
          
</div>

 @endsection

@section('script')

<script>
$(document).ready(function certificate() { 
$('#address_id2').addClass('d-none');
$('#desc_address2').addClass('d-none');

});
 $('.js-example-basic-single').select2();

 $("#store_id").change(function(){
        if($(this).val()==1)
         {
      $('#address_id2').removeClass('d-none');
      $('#desc_address2').removeClass('d-none');
      $('#address_select').attr('required', false);
      $('#text_desc_address').attr('required', false);

         }else
         {
           $('#address_id2').addClass('d-none');
           $('#desc_address2').addClass('d-none');
           $('#address_select').attr('required', true);
          $('#text_desc_address').attr('required', true);
         }
        });
</script>
    @endsection