@extends('admin.vadmin.lay')
@section('title') - 
إدارة  الخدمات 
@endsection

@section('content')

<div class="container"> 
               
                  <div class="row">
                <div class="col-md-12">
                  @can('add service')
                  <a href="/admin/service/create" class="btn btn-info float-left">
                                       <i class="fa fa-plus fa-2x"></i> اضافة خدمة 
                                       
                    </a>
                  @endcan

       </div></div>
      
       @if(count($services)>0)
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
                    <th>الوصف</th>
                    <th>الصالون</th>
                    <th>السعر</th>
                  
                    @can('edit service')
                    <th>تعديل</th>
                    @endcan
                    @can('delete service')
                    <th>حذف</th>
                    @endcan

                  </tr>
                </thead>
                <tbody>
                @foreach($services as $service)
                 <tr>
                  <td>{{$service->id}}</td>
                  <td><img src="{{$service->image}}" height="80" width="75"></td>
                    <td>{{$service->name}}</td>
                    <td>{{$service->desc}}</td>
                    <td>{{$service->salon?$service->salon->name:''}}</td>
                    <td>{{$service->price}}</td>
                  @can('edit service')
                    <td> 

                      <a href="/admin/service/{{$service->id}}/edit" class="btn btn-info float-left">
                                                      <i class="fa fa-edit fa-2x"></i> تعديل
                                                      </a>
                                                      
                                       
                                                    </td>
               @endcan
               @can('delete service')
               <td>
                    {!!Form::open(['action' => ['App\Http\Controllers\ServiceController@destroy',$service->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
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
       