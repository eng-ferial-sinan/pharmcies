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
                <li class="breadcrumb-item"><a href="/">الرئيسية</a></li>
                <li aria-current="page" class="breadcrumb-item active">المنتجات</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-9">
            <div class="box text-lg-right">
              <h1>المنتجات</h1>
              <p> ، نقدم مجموعة واسعة من أفضل المنتجات التي وجدناها ونختارها بعناية في جميع أنحاء العالم </p>
            </div>
            <div class="box info-bar">
              <div class="row">
                {{-- <div class="col-md-12 col-lg-4 products-showing">تسوق <strong>12</strong> من <strong>25</strong> منتجات</div> --}}
                <div class="col-md-12 col-lg-7 products-number-sort">
                  <form  method="get" action="/shop" class="form-inline d-block d-lg-flex justify-content-between flex-column flex-md-row">
                    <div class="products-number">
                        <button type="submit" class="btn btn-sm btn-primary">
                         <strong>عرض</strong>
                        </button>
                    </div>
                    
                    <div class="products-sort-by mt-2 mt-lg-0"><strong>ترتيب حسب</strong>
                      <select name="sort_by" class="form-control">
                        <option value="price" {{isset($filter['sort_by'])?($filter['sort_by']=='price'?'selected':''):''}} >السعر</option>
                        <option value="name" {{isset($filter['sort_by'])?($filter['sort_by']=='name'?'selected':''):''}} >الاسم</option>
                        <option value="created_at" {{isset($filter['sort_by'])?($filter['sort_by']=='created_at'?'selected':''):''}}>الجديد أولا</option>
                      </select>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="row products">
              
                @foreach ($products as $product)
                    
            <div class="col-lg-4 col-md-6">
                <div class="product">
                  <div class="flip-container">
                    <div class="flipper">
                      <div class="front"><a href=#void"><img src="{{$product->image}}" alt="" class="img-fluid"></a></div>
                      <div class="back"><a href=#void"><img src="{{$product->image}}" alt="" class="img-fluid"></a></div>
                    </div>
                  </div><a href=#void" class="invisible"><img src="{{$product->image}}" alt="" class="img-fluid"></a>
                  <div class="text">
                    <h3><a href=#void">{{$product->name}}</a></h3>
                    <p class="price"> 
                        {{$product->price}} ر.ي
                    </p>
                    <p class="buttons"><a href="/cart/add/{{$product->id}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>إضافةإلى السلة</a></p>
                  </div>
                  <!-- /.text-->
                </div>
                <!-- /.product            -->
              </div>
              @endforeach
              
              
              <!-- /.products-->
            </div>
            <div class="pages">
                <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                    {{ $products->appends(['sort_by'=>(isset($filter['sort_by'])?$filter['sort_by']:''),'search'=>(isset($filter['search'])?$filter['search']:''),'id'=>(isset($id)?$id:0)])->links() }}
                </nav>
            </div>
          </div>
          <!-- /.col-lg-9-->
          <div class="col-lg-3 text-right" dir="rtl">
            <!--
            *** MENUS AND FILTERS ***
            _________________________________________________________
            -->
            <div class="card sidebar-menu mb-4">
              <div class="card-header">
                <h3 class="h4 card-title">الاصناف</h3>
              </div>
              <div class="card-body">
                <ul class="nav nav-pills flex-column category-menu">
                    @foreach ($categories as $category)
                    <li>
                        <a href="/shop/{{$category->id}}" class="nav-link {{$id==$category->id? 'active': ' '}}">{{$category->name}} 
                        <span class="badge badge-secondary">{{$category->product->count()}}</span></a>
                      </li>
                    @endforeach
                  
                </ul>
              </div>
            </div>
            
            <!-- *** MENUS AND FILTERS END ***-->
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
