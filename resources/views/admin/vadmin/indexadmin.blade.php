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
    <a href="/admin/salon">
      <div class="widget-small info coloured-icon"><i class="icon fa fa-tag fa-3x"></i>
        <div class="info">
          <h4>الصوالين</h4>
          <p><b>{{\App\Models\Salon::count()}}</b></p>
        </div>
      </div>
      </a>
    </div>
       
    <div class="col-md-6 col-lg-3">
      <a href="/admin/service">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-tag fa-3x"></i>
          <div class="info">
            <h4>الخدمات</h4>
            <p><b>{{\App\Models\Service::count()}}</b></p>
          </div>
        </div>
        </a>
      </div>
    <div class="col-md-6 col-lg-3">
      <a href="/admin/reservation">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-tag fa-3x"></i>
          <div class="info">
            <h4>الحجوزات</h4>
            <p><b>{{\App\Models\Reservation::count()}}</b></p>
          </div>
        </div>
        </a>
      </div>
         
        </div>
      

      @endsection

   