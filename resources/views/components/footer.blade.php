@php 

  $info= sitinfo();
  @endphp
<div id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <h4 class="mb-3">الصفحات</h4>
          <ul class="list-unstyled">
            <li><a href="/">الرئيسية</a></li>
            <li><a href="/shop">تسوق</a></li>
            <li><a href="/contact">اتصل بنا</a></li>
          </ul>
          <hr>
        </div>
        <!-- /.col-lg-3-->
        <!-- /.col-lg-3-->
        <div class="col-lg-6 col-md-6">
          <h4 class="mb-3">أين تجدنا</h4>
          <p>{{$info->address}}
          </p><a href="/contact">الذهاب لصفحة التواصل</a>
          <hr class="d-block d-md-none">
        </div>
        <!-- /.col-lg-3-->
        <div class="col-lg-3 col-md-6">
          <h4 class="mb-3">ابق على تواصل</h4>
          <p class="social"><a href="{{$info->facebook}}" class="facebook external">
            <i class="fa fa-facebook"></i></a>
            <a href="{{$info->twitter}}" class="twitter external">
              <i class="fa fa-twitter"></i></a>
            <a href="{{$info->instagram}}" class="instagram external">
              <i class="fa fa-instagram"></i></a>
              <a href="{{$info->google_plus}}" class="gplus external">
                <i class="fa fa-google-plus">
              </i></a><a href="mailto:{{$info->email}}" class="email external">
                <i class="fa fa-envelope"></i></a></p>
        </div>
        <!-- /.col-lg-3-->
      </div>
      <!-- /.row-->
    </div>
    <!-- /.container-->
  </div>

  <div id="copyright">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mb-2 mb-lg-0">
          <p class="text-center text-lg-left">© 2019 المتجر الالكتروني.</p>
        </div>
        <div class="col-lg-6">
          <!-- <p class="text-center text-lg-right">Template design by <a href="https://bootstrapious.com/p/big-bootstrap-tutorial">Bootstrapious</a> -->
            <!-- If you want to remove this backlink, pls purchase an Attribution-free License @ https://bootstrapious.com/p/obaju-e-commerce-template. Big thanks!-->
          </p>
        </div>
      </div>
    </div>
  </div>