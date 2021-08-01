@php 

$info= sitinfo();
@endphp
<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>    {{$info->nameAr}} </title>

    <!-- Bootstrap Core CSS -->
    <link href="/backend/css/rtl/bootstrap.min.css" rel="stylesheet">
    
    <!-- not use this in ltr -->
    {{-- <link href="/backend/css/rtl/bootstrap.rtl.css" rel="stylesheet"> --}}

    <!-- MetisMenu CSS -->
    {{-- <link href="/backend/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet"> --}}

    <!-- Timeline CSS -->
    {{-- <link href="/backend/css/plugins/timeline.css" rel="stylesheet"> --}}

    <!-- Custom CSS -->
    <link href="/backend/css/rtl/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/backend/css/plugins/morris.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- <link rel="stylesheet" href="{{asset('theme/css/fontawesome-all.min.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{asset('theme/css/bootstrap.min.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{asset('theme/css/jquery.fancybox.min.css')}}"> --}}
    {{--<link rel="stylesheet" href="{{asset('theme/css/style.css')}}">--}}
        <link rel="stylesheet" href="{{asset('theme/css/ar_style.css')}}">
    
    <!-- Custom Fonts -->
    {{-- <link href="/backend/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css"> --}}
    {{-- <link rel="stylesheet" href="/vad1/css/font-awesome.min.css"> --}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="wrapper">


  <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    

    @include('admin.vadmin.header') 


     @include('admin.vadmin.sidebar') 
    </nav>

       <!-- Content Wrapper. Contains page content -->
       <div id="page-wrapper">
            
        <section class="content-header">
          <h1>
            لوحة التحكم
            <small>@yield('head')</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i></a></li>
            <li class="active">الرئيسية</li>
          </ol>
        </section>
        @include('admin.inc.messages')

            <!-- /.col-lg-12 -->
            @yield('content')

        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>


      <!-- /.content -->
  </div>



  

  <!-- /.content-wrapper -->
@include('admin.vadmin.footer')

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


    <!-- jQuery Version 1.11.0 -->
    <script src="/backend/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/backend/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/backend/js/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="/backend/js/raphael/raphael.min.js"></script>
    <script src="/backend/js/morris/morris.min.js"></script>
 <!-- DataTables JavaScript -->
 {{-- <script src="/backend/js/jquery/jquery.dataTables.min.js"></script>
 <script src="/backend/js/bootstrap/dataTables.bootstrap.min.js"></script>
 <link href="//cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
 <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> --}}
 
 {{-- <script type="text/javascript" src="/vad1/js/plugins/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="/vad1/js/plugins/dataTables.bootstrap.min.js"></script> --}}
 {{-- <link href="//cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
 --}}
    <!-- Custom Theme JavaScript -->
    <script src="/backend/js/sb-admin-2.js"></script>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('full_text');
</script>


    <script>


$(document).ready(function() {

 

  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
  $(".js-delete-product-image").click(function(t) {
              t.preventDefault();
              var e = $(this).data("id");
              $.post("/admin/photo/" + e + "/delete", function() {
                  $(".js-product-image-" + e).remove()
              })
              
            });

            $(".js-delete-blog-image").click(function(t) {
              t.preventDefault();
              var e = $(this).data("id");
              $.post("/admin/image/" + e + "/delete", function() {
                  $(".js-blog-image-" + e).remove()
              })
              
            });
            
            $(".js-delete-seirah-image").click(function(t) {
              t.preventDefault();
              var e = $(this).data("id");
              $.post("/admin/certificat/" + e + "/delete", function() {
                  $(".js-seirah-image-" + e).remove()
              })
              
            });

$(".btn-Add").click(function(){ 
    var html = $(".clone").html();
    $(".increment").after(html);
});

$("body").on("click",".btn-remove",function(){ 
    $(this).parents(".control-group1").remove();
});

});

//      $(document).ready(function() {
//     var table = $('#dataTables-example').DataTable( {
//        rowReorder: {
//             selector: 'td:nth-child(2)'
//         },
//         responsive: true
//     } );
// } );
  </script>
@yield('scripts')

</body>
</html>
