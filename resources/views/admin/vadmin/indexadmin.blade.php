@extends('admin.vadmin.lay')

@section('content')

      <div class="row">
<style>
a {
    color: #594C25;
    text-decoration: none !important;
    background-color: transparent;
    -webkit-text-decoration-skip: objects;
}
</style>
  

  
  <div class="col-md-6 col-lg-3">
    <a href="/plans">
      <div class="widget-small info coloured-icon"><i class="icon fa fa-tag fa-3x"></i>
        <div class="info">
          <h4>الخطط</h4>
          <p><b>{{\App\Models\Plan::count()}}</b></p>
        </div>
      </div>
      </a>
    </div>
       
 
    <div class="col-md-6 col-lg-3">
      <a href="/subscriptions">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-tag fa-3x"></i>
          <div class="info">
            <h4>الاشتراكات</h4>
            <p><b>{{\App\Models\Subscription::count()}}</b></p>
          </div>
        </div>
        </a>
      </div>
         
        </div>
      

      @endsection

   