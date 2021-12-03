@extends('admin.vadmin.lay')

@section('title') - 

حسابات الطلبات   

@endsection



@section('content')

     <div class="container">
          <div class="row p-0 m-0">
             <div class="col-md-12 ">

                    <form action="/admin/reports" id="print" method="get" class="form-horizontal p-0 m-0"> 
                      <div class="row tile mt-0">
                        <div class="form-group col-md-2">
                          <label for="name"> من تاريخ  </label>
                          <input type="date" name="fromdate" value="{{isset($filter['fromdate'])?$filter['fromdate']:date('Y-m-d', strtotime(' - 1 month'))}}"  class="form-control" >
                        </div>

                        <div class="form-group col-md-2">        
                          <label for="name">الى تاريخ  </label>
                          <input type="date" name="todate" value="{{isset($filter['todate'])?$filter['todate']:date('Y-m-d')}}" class="form-control">
                        </div>
                        <div class="form-group col-md-2" >
                            {{Form::label('product_id','  المنتج  ')}}
                            {{Form::select('product_id',$products,(isset($filter['product_id'])?$filter['product_id']:'') , ['class' => 'form-control select2 ', 'placeholder' => ' الكل'])}}
                        </div> 
                        <div class="form-group col-md-2">
                            {{Form::label('status_id','حالة الطلب')}}
                            {{Form::select('status_id[]',$status,(isset($filter['status_id'])?$filter['status_id']:'') , [ 'multiple'=>"multiple" ,'class' => 'form-control select2 '])}}
                        </div>
                        <div class="form-group col-md-2 pt-4 mt-1" >
                        <input id="btn" class="btn btn-primary form-control"  type="submit" value="عرض">    
                        </div>
                    </div>

                  </form>

                @if(count($items)>0)
                      <div class="row">
                        <div class="col-md-12">
                          <div class="tile">
                            <div class="tile-body">
                              <table class="table table-hover table-bordered">
                                    <thead>
                                      <tr>               
                                        <th colspan="1"> اجمالي عدد المنتجات : {{$total_count}}</th>
                                        <th colspan="1">   اجمالي سعر المنتجات: {{number_format($total_price)}}</th>
                                        <th colspan="2">   الاجمالي  الكلي   : {{number_format($total_sum)}}</th>
                                      </tr>
                                      <tr>               
                                        <th colspan="2">  المنتج :{{$product_info?$product_info->name : 'غير محدد'}}</th>
                                        <th colspan="2">الفترة:{{isset($filter['fromdate'])?$filter['fromdate']:date('Y-m-d')}} - {{isset($filter['todate'])?$filter['todate']:date('Y-m-d')}}</th>
                                      </tr>
                                  <thead>
                              </table>
                              <table class="table table-striped- table-bordered table-hover table-checkable  " id="report">
                                <thead>                 
                                  <tr>
                                    <th> الاسم</th>
                                    <th>العدد </th>
                                    <th>السعر</th>
                                    <th>الاجمالي</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($items as $item)
                                  <tr>
                                  <td>{{$item->products?$item->products->name:'='}}</td>
                                  <td>{{$item->count}}</td>
                                  <td>{{number_format($item->price)}} </td>
                                  <td>{{number_format($item->sum)}}</td> 
                                  </tr>      
                                  @endforeach
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th> الاسم</th>
                                    <th>العدد </th>
                                    <th>السعر</th>
                                    <th>الاجمالي</th>
                                  </tr>
                                </tfoot>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>

              @else

                  <p> لا توجد بيانات حالياً</p>

              @endif

        </div>
      </div>
   </div>

 







 

            

@endsection



@section('script')



<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>

<script>  

 $('.select2').select2();  



$(document).ready(function() {

    $('#report').DataTable( {

       responsive: true,

        dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>

			<'row'<'col-sm-12'tr>>

			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,

        buttons: [

             

                    {

                    extend: 'excelHtml5',

                    autoFilter: true,

                    sheetName: 'Exported data'

                }

                 ,'pdfHtml5',

           

               { 

                extend: 'print',

                //autoPrint: false,

                messageTop: '<table><tr><td> <img src"{{url('logo.png')}}"></td><td>اسم الشركة: شركة الادوية <br/>الفنرة  من  :1-1-2020 الي 12-2020 </td></tr></table>',

                title: '',

                //For repeating heading.

                customize: function ( win ) {

                    $(win.document.body)

                        .css( {"direction": "rtl",    "overflow": "visible", "font-size": "10pt"})

                        .prepend(

                            '<img src="{{url('super-watermark.png')}}" style="position:absolute; top:50%; left:50%;" />'

                        );

                    $(win.document.body).find( 'table' )

                        .addClass( 'compact' )

                        .css( 'font-size', 'inherit' );

                }

            }

          ]  ,

        iDisplayLength:10

          } );
} );





</script>  



@endsection 