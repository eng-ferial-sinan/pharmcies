

@php 

$info= sitinfo();
@endphp
<!DOCTYPE html>
 
<html dir="rtl" lang="ar">
  <head> 
 
     <title>    {{$info->nameAr}} </title>
     <meta name="_token" content="{{csrf_token()}}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('head')
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="/vad1/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




  </head>
  <body class="app sidebar-mini rtl">
 
    <!-- Navbar-->
    @include('admin.vadmin.header');
    <!-- Sidebar menu-->
    @include('admin.vadmin.sidebar');
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> {{$info->nameAr}}
          @yield('title')
          </h1>
          <p>لوحة تحكم  </p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="/admin/home#">لوحة التحكم</a></li>
        </ul>
      </div>
 

      
      @include('admin.inc.messages')
 
      @yield('content')
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="/vad1/js/jquery-3.2.1.min.js"></script>
    <script src="/vad1/js/popper.min.js"></script>
    <script src="/vad1/js/bootstrap.min.js"></script>
    <script src="/vad1/js/main.js"></script>

    <!-- The javascript plugin to display page loading on top-->
    <script src="/vad1/js/plugins/pace.min.js"></script>

    <script type="text/javascript" src="/vad1/js/plugins/select2.min.js"></script>

    <!-- Page specific javascripts-->
    <script type="text/javascript" src="/vad1/js/plugins/chart.js"></script>

     <!-- The javascript plugin to display page loading on top-->
     <script src="/vad1/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="/vad1/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/vad1/js/plugins/dataTables.bootstrap.min.js"></script>
    <link href="//cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <script type="text/javascript">
    // $('#sampleTable').DataTable();
    $(document).ready(function() {
    var table = $('#sampleTable').DataTable( {
       rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
} );</script>

      <style type="text/css">
  
    #image_preview{
      
      padding: 1px;
      width: 300px !important;
    }
    #image_preview img{
      width: 300px !important;
     max-height:250px;
      padding: 5px;
    }
    #image_preview1 img{
      width: 200px !important;
      padding: 5px;
    }
  </style>
     

    @yield('script')

<script type="text/javascript">
 $('#demoSelect').select2();
         
  
</script>
<script>      
    function ConfirmDelete( )
    {
       var msg = "هل تريد فعلاً   حذف  "+"?";
    var x = confirm(    msg);
    if (x)
      return true;
    else
      return false;
    }
  
</script>
  </body>
</html>