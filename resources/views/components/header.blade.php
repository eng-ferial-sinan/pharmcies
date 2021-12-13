<header class="header mb-5">
    <!--
    *** TOPBAR ***
    _________________________________________________________
    -->
    @php 

  $info= sitinfo();
  @endphp
    <div id="top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 offer mb-3 mb-lg-0">
              {{-- <a href="#" class="btn btn-success btn-sm">عرض اليوم</a><a href="#" class="ml-1">احصل على خصم ثابت 35٪ على الطلبات التي تزيد عن 50 دولارًا!</a> --}}
            </div>
          <div class="col-lg-6 text-center text-lg-right">
            <ul class="menu list-inline mb-0">
              @auth
              <li class="list-inline-item"><a href="/customer/account" >حسابي</a></li>
              <li class="list-inline-item"><a href="/customer/orders" >طلباتي</a></li>
              @endauth
              @guest
              <li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#login-modal">تسجيل دخول</a></li>
              <li class="list-inline-item"><a href="/register">إنشاء حساب</a></li>
              @endguest  
              <li class="list-inline-item"><a href="/contact">اتصل بنا</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">تسجيل دخول العميل</h5>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <form action="/customer/login" method="post">
                @csrf
                <div class="form-group">
                  <input name="email" id="email-modal" type="text" placeholder="email" class="form-control">
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                   @enderror
                </div>
                <div class="form-group">
                  <input name="password" id="password-modal" type="password" placeholder="password" class="form-control">
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                   @enderror
                </div>
                <p class="text-center">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> تسجيل دخول</button>
                </p>
              </form>
              <p class="text-center text-muted">لم يتم تسجيلة بعد؟</p>
              <p class="text-center text-muted"><a href="/register"><strong>انشاء حساب الان</strong></a>! إنه سهل ويتم تنفيذه في دقيقة واحدة ويتيح لك الوصول إلى خصومات خاصة وأكثر من ذلك بكثير!</p>
            </div>
          </div>
        </div>
      </div>
      <!-- *** TOP BAR END ***-->
      
      
    </div>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a href="/" class="navbar-brand home"><img src="{{$info->image}}" alt="{{$info->nameAr}}" class="d-none d-md-inline-block">
          <img src="{{$info->image}}" alt="{{$info->nameAr}}" class="d-inline-block d-md-none">
        <span class="sr-only">Obaju - go to homepage</span></a>
        <div class="navbar-buttons">
          <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler">
            <span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
          <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler">
            <span class="sr-only">Toggle search</span><i class="fa fa-search"></i></button>
          <a data-toggle="collapse" href="#ViewCart" class="btn btn-outline-secondary navbar-toggler">
            <i class="fa fa-shopping-cart"></i></a>

        </div>

        <div id="navigation" class="collapse navbar-collapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a href="/" class="{{ (Request::is('/') ? 'active' : '')}} nav-link ">الرئيسية</a></li>
            <li class="nav-item"><a href="/shop" class="nav-link {{ (Request::is('/shop*') ? 'active' : '')}}">تسوق</a></li>
            @php
                 $categories=\App\Models\Category::orderBy('sort','asc')->take(3)->get();
            @endphp
            @foreach ($categories as $category)
            <li class="nav-item"><a href="/shop/{{$category->id}}" class="nav-link {{ (Request::is('/shop/'.$category->id) ? 'active' : '')}}">{{$category->name}}</a></li>
              
            @endforeach
            <li class="nav-item"><a href="/contact" class="nav-link {{ (Request::is('/contact*') ? 'active' : '')}}">اتصل بنا</a></li>
            
          </ul>
          <div class="navbar-buttons d-flex justify-content-end">
            <!-- /.nav-collapse-->
            <div id="search-not-mobile" class="navbar-collapse collapse"></div>
            <a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block">
              <span class="sr-only">تبديل البحث</span><i class="fa fa-search"></i></a>
            <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block">
              <a data-toggle="collapse" href="#ViewCart" class="btn btn-primary navbar-btn">
                <i class="fa fa-shopping-cart"></i>
                <span>( {{ session()->has('cart') ? session()->get('cart')->totalQty : '0' }}) عناصر في السلة</span></a>
              </div>
          </div>
        </div>
      </div>
    </nav>
    <div id="search" class="collapse">
      <div class="container">
        <form method="get" action="/shop" class="ml-auto">
          <div class="input-group">
            <input type="text"  name="search" value="{{isset($filter['search'])?$filter['search']:''}}" placeholder="Search" class="form-control">
            <div class="input-group-append">
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>

      <div class="cart">
        {{-- <label data-toggle="collapse" data-target="#ViewCart">
            <i class="fa fa-cart-plus" aria-hidden="true"></i>
            <span class="items-count">7</span> – Items
        </label>  --}}
        <div class="items-list collapse" id="ViewCart"> 
            @if (session()->has('cart'))
            @foreach (session()->get('cart')->items as $item)
            <div class="item">
              <div class="row">
                  <div class="col-4">
                      <div class="item-pic">
                          <img src="{{$item['image']}}" class="img-fluid" alt="product">
                      </div>
                  </div>
                  <div class="col-8 pl-0">
                      <h6 class="item-name">{{$item['name']}}</h6>
                      <p class="item-price">{{$item['price']}}</p>
                      <span class="item-remove">
                        <a href="/cart/remove/{{$item['id']}}">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                      </span>
                  </div>                           
              </div>
          </div> 
            @endforeach
            
            @endif                       

            <div class="row">
                <div class="view-cart">
                    <span class="close-cart" data-toggle="collapse" data-target="#ViewCart">اخفاء</span>
                    <a href="/cart">عرض السلة</a>                                                     
                </div>
            </div>
        </div>
    </div>
    <style>

      .cart label{
        position: relative;
        color: #ffffff;
        font-size: 20px;
        cursor: pointer;
    }
    .cart .item i{
        font-size: 25px;
    }
    .cart .items-count {
        position: absolute;
        top: -14px;
        left: 17px;
        background-color: #ffffff;
        width: 18px;
        height: 18px;
        text-align: center;
        font-size: 12px;
        border-radius: 100%;
        color: #ff9800;
        align-items: center;
        display: grid;
        font-weight: bold;
    }
    .cart .items-list {
        background-color: #fff;
        padding: 15px 15px 0px 15px;
        border: 1px solid #ddd;
        width: 300px;
        border-radius: 4px;
        box-shadow: 0px 0px 8px 0px #888;
        position: absolute;
        right: 5px;
        z-index: 5;
    }
    .cart .item-name,
    .cart .item-price {
        margin: 0px 0px 5px;
    }
    .cart .item-pic {
        width: 100%;
        height: 50px;
        overflow: hidden;
        border: 1px solid #ddd;
    }
    .cart .item-pic img {
        height: 100%;
        margin: 0 auto;
        display: block;
    }
    .cart .item-remove {
        position: absolute;
        right: 15px;
        top: 15px;
    }
    .cart .item-remove i {
        font-size: 20px;
        color: #FF5722;
        opacity: 0.5;
        cursor: pointer;
    }
    .cart .item-remove i:hover {
        opacity: 1;
    }
    .cart .item {
        padding: 10px 0px;
        border-bottom: 1px solid #ddd;
    }
    .cart .view-cart {
        text-align: center;
        width: 100%;
        padding: 10px 15px;
        background-color: #eee;
        font-size: 18px;
        text-decoration: none;
        margin-top: -1px;
    }
    .cart .close-cart {
        float: left;
        color: #029687;
        cursor: pointer;
    }
    .cart .view-cart a {
        float: right;
        color: #03A9F4;
        text-decoration: none;
    }
    </style>


  </header>

  