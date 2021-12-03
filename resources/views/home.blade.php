@extends('layouts.front_app')

@section('content')
<div id="all">
    <div id="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div id="main-slider" class="owl-carousel owl-theme">
                @foreach ($slides as $slide)
                <div class="item">
                    <img src="{{$slide->image}}" alt="" class="img-fluid">
                  </div>
                @endforeach  
            </div>
            <!-- /#main-slider-->
          </div>
        </div>
      </div>
      <!--
      *** ADVANTAGES HOMEPAGE ***
      _________________________________________________________
      -->
      <div id="advantages">
        <div class="container">
          <div class="row mb-4">
            <div class="col-md-4">
              <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                <div class="icon"><i class="fa fa-heart"></i></div>
                <h3><a href="#">نحن نحب عملائنا</a></h3>
                <p class="mb-0">نحن معروفون بتقديم أفضل خدمة ممكنة على الإطلاق</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                <div class="icon"><i class="fa fa-tags"></i></div>
                <h3><a href="#">أفضل الأسعار</a></h3>
                <p class="mb-0">يمكنك التحقق من ضبط ارتفاع المربعات عند استخدام نص أطول مثل هذا في إحداها.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                <div class="icon"><i class="fa fa-thumbs-up"></i></div>
                <h3><a href="#">100٪ ضمان الرضا</a></h3>
                <p class="mb-0">عوائد مجانية على كل شيء لمدة 3 أشهر.</p>
              </div>
            </div>
          </div>
          <!-- /.row-->
        </div>
        <!-- /.container-->
      </div>
      <!-- /#advantages-->
      <!-- *** ADVANTAGES END ***-->
      <!--
      *** HOT PRODUCT SLIDESHOW ***
      _________________________________________________________
      -->
      <div id="hot">
        <div class="box py-4">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h2 class="mb-0">الاكثر مبيعا</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="product-slider owl-carousel owl-theme">

            @foreach ($new_products as $new_product)
                
            <div class="item">
                <div class="product">
                  <div class="flip-container">
                    <div class="flipper">
                      <div class="front"><a href="#"><img src="{{$new_product->image}}" alt="" class="img-fluid"></a></div>
                      <div class="back"><a href="#"><img src="{{$new_product->image}}" alt="" class="img-fluid"></a></div>
                    </div>
                  </div><a href="#" class="invisible"><img src="{{$new_product->image}}" alt="" class="img-fluid"></a>
                  <div class="text">
                    <h3><a href="#">{{$new_product->name}}</a></h3>
                    <p class="price"> 
                       {{$new_product->price}}   ر.ي
                    </p>
                    <p class="buttons"><a href="/cart/add/{{$new_product->id}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>إضافةإلى السلة</a></p>

                  </div>
                  <!-- /.text-->
                  <!-- /.ribbon-->
                  <div class="ribbon new">
                    <div class="theribbon">جديد</div>
                    <div class="ribbon-background"></div>
                  </div>
                  <!-- /.ribbon-->
                  <!-- /.ribbon-->
                </div>
                <!-- /.product-->
              </div>
            @endforeach
            <!-- /.product-slider-->
          </div>
          <!-- /.container-->
        </div>
        <!-- /#hot-->
        <!-- *** HOT END ***-->
      </div>
      <div id="hot">
        <div class="box py-4">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h2 class="mb-0">جديد المتجر</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="product-slider owl-carousel owl-theme">
          
            @foreach ($new_products as $new_product)
                
            <div class="item">
                <div class="product">
                  <div class="flip-container">
                    <div class="flipper">
                      <div class="front"><a href="#"><img src="{{$new_product->image}}" alt="" class="img-fluid"></a></div>
                      <div class="back"><a href="#"><img src="{{$new_product->image}}" alt="" class="img-fluid"></a></div>
                    </div>
                  </div><a href="#" class="invisible"><img src="{{$new_product->image}}" alt="" class="img-fluid"></a>
                  <div class="text">
                    <h3><a href="#">{{$new_product->name}}</a></h3>
                    <p class="price"> 
                       {{$new_product->price}}   ر.ي
                    </p>
                    <p class="buttons"><a href="/cart/add/{{$new_product->id}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>إضافةإلى السلة</a></p>

                  </div>
                  <!-- /.text-->
                  <!-- /.ribbon-->
                  <div class="ribbon new">
                    <div class="theribbon">جديد</div>
                    <div class="ribbon-background"></div>
                  </div>
                  <!-- /.ribbon-->
                  <!-- /.ribbon-->
                </div>
                <!-- /.product-->
              </div>
            @endforeach
          
         
            
            <!-- /.product-slider-->
          </div>
          <!-- /.container-->
        </div>
        <!-- /#hot-->
        <!-- *** HOT END ***-->
      </div>
      <!--
      *** GET INSPIRED ***
      _________________________________________________________
      -->
      <!-- <div class="container">
        <div class="col-md-12">
          <div class="box slideshow">
            <h3>Get Inspired</h3>
            <p class="lead">Get the inspiration from our world class designers</p>
            <div id="get-inspired" class="owl-carousel owl-theme">
              <div class="item"><a href="#"><img src="/frontend/img/getinspired1.jpg" alt="Get inspired" class="img-fluid"></a></div>
              <div class="item"><a href="#"><img src="/frontend/img/getinspired2.jpg" alt="Get inspired" class="img-fluid"></a></div>
              <div class="item"><a href="#"><img src="/frontend/img/getinspired3.jpg" alt="Get inspired" class="img-fluid"></a></div>
            </div>
          </div>
        </div>
      </div> -->
      <!-- *** GET INSPIRED END ***-->
      <!--
      *** BLOG HOMEPAGE ***
      _________________________________________________________
      -->
      <!-- /.container-->
      <!-- *** BLOG HOMEPAGE END ***-->
    </div>
  </div>
@endsection
