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
          <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
          <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></button>
          <a href="/cart" class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
        </div>
        <div id="navigation" class="collapse navbar-collapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a href="/" class="{{ (Request::is('/') ? 'active' : '')}} nav-link ">الرئيسية</a></li>
            <li class="nav-item"><a href="/shop" class="nav-link {{ (Request::is('/shop*') ? 'active' : '')}}">تسوق</a></li>
            {{-- <li class="nav-item"><a href="/about" class="nav-link {{ (Request::is('/about*') ? 'active' : '')}}">من نحن</a></li> --}}
            <li class="nav-item"><a href="/contact" class="nav-link {{ (Request::is('/contact*') ? 'active' : '')}}">اتصل بنا</a></li>
            
          </ul>
          <div class="navbar-buttons d-flex justify-content-end">
            <!-- /.nav-collapse-->
            <div id="search-not-mobile" class="navbar-collapse collapse"></div>
            <a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block">
              <span class="sr-only">تبديل البحث</span><i class="fa fa-search"></i></a>
            <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block">
              <a href="/cart" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span>( {{ session()->has('cart') ? session()->get('cart')->totalQty : '0' }}) عناصر في السلة</span></a></div>
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
  </header>