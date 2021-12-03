@extends('admin.vadmin.lay')
@section('title') - 
إدارة  المنتجات
@endsection

@section('content')

<div class="container"> 
               
                  <div class="row">
                <div class="col-md-12">
                  @can('add product')
                  <a href="/admin/product/create" class="btn btn-info float-left">
                                       <i class="fa fa-plus fa-2x"></i> اضافة منتج
                                       
                    </a>
                  @endcan

       </div></div>
      
       @if(count($products)>0)
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الصنف</th>
                    <th>السعر</th>
                  
                    @can('edit product')
                    <th>تعديل</th>
                    @endcan
                    @can('delete product')
                    <th>حذف</th>
                    @endcan

                  </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                 <tr>
                  <td>{{$product->id}}</td>
                  <td><img src="{{$product->image}}" height="80" width="75"></td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category?$product->category->name:''}}</td>
                    <td>{{$product->price}}</td>
                  @can('edit product')
                    <td> 

                      <a href="/admin/product/{{$product->id}}/edit" class="btn btn-info float-left">
                                                      <i class="fa fa-edit fa-2x"></i> تعديل
                                                      </a>
                                                      
                                       
                                                    </td>
               @endcan
               @can('delete product')
               <td>
                    {!!Form::open(['action' => ['App\Http\Controllers\ProductController@destroy',$product->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                    {{Form::hidden('_method','DELETE')}}
                       <button class ="btn btn-danger mr-3 ml-3" type="submit"><i class="fa fa-md fa-trash"></i>
                       </button>
                       {!!Form::close()!!}
                    </td>
                    @endcan

                    
                  </tr>
                   
                   
                  @endforeach
                   
                   

                </tbody>
              </table>

            </div>
          </div>
        </div>
        </div>
      </div>
    


                     
                     
                    @else
                        <p> لا توجد بيانات حالياً</p>
                    @endif
        </div>



            
@endsection
@section('script')
<script src="/js/repeater.js" type="text/javascript"></script>
    <script>
        /* Create Repeater */
        $("#repeater").createRepeater({
            showFirstItemToDefault: true,
        });
    </script>
 
 @endsection
       