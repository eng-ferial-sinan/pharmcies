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
  <a href="/pharmacy">
    <div class="widget-small info coloured-icon"><i class="icon fa fa-tag fa-3x"></i>
      <div class="info">
        <h4>الصيدليات</h4>
        <p><b>{{\App\Models\pharmacy::count()}}</b></p>
      </div>
    </div>
    </a>
  </div>
  
  <div class="col-md-6 col-lg-3">
    <a href="/medicine">
      <div class="widget-small info coloured-icon"><i class="icon fa fa-tag fa-3x"></i>
        <div class="info">
          <h4>الادوية</h4>
          <p><b>{{\App\Models\medicine::count()}}</b></p>
        </div>
      </div>
      </a>
    </div>
       
 
    <div class="col-md-6 col-lg-3">
      <a href="/order">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-tag fa-3x"></i>
          <div class="info">
            <h4>الطلبات</h4>
            <p><b>{{\App\Models\order::count()}}</b></p>
          </div>
        </div>
        </a>
      </div>
         
        </div>
      

      @endsection

   