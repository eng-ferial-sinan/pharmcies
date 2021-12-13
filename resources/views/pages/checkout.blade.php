@extends('layouts.front_app')

@section('content')

        
   
<div id="all">
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <!-- breadcrumb-->
            <nav aria-label="breadcrumb text-right" dir="rtl">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                <li aria-current="page" class="breadcrumb-item active">تسجيل الخروج - العنوان</li>
              </ol>
            </nav>
          </div>
          
          <div id="checkout" class="col-lg-9 ">
            <div class="box text-lg-right">
              <form method="post" action="/checkout/selec_address">
                @csrf
                <h1>تسجيل الخروج - العنوان</h1>
                <div class="nav flex-column flex-md-row nav-pills text-center">
                  <a href="#" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-map-marker">                  
                    </i>Address
                  </a>
                </div>
                <div class="content py-3">
                  <!-- /.row-->
                  <div class="row">
                      <div class="form-group">
                        <label for="address">العناوين</label>
                        <select id="address" class="form-control">
                          <option value="0" disabled >اختار عناون</option>
                          @foreach ($addresses as $address)
                              <option value="{{$address->id}}">{{$address->address}}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
                  <!-- /.row-->
              </div>
                <div class="box-footer d-flex justify-content-between">
                  <a href="/cart" class="btn btn-outline-secondary">
                  <i class="fa fa-chevron-left"></i>العودة إلى سلة</a>
                  <button type="submit" class="btn btn-primary">
                    استمر في طريقة اتمام الطلبية<i class="fa fa-chevron-right"></i></button>
                </div>
              </form>
            </div>
            <!-- /.box-->
          </div>
          <!-- /.col-lg-9-->
          <!-- /.col-lg-3-->
        </div>
      </div>
    </div>
  </div>
@endsection
