@extends('admin.vadmin.lay')
@section('title') - 
إدارة  المنتجات
@endsection

@section('content')

<div class="container"> 
               
                  <div class="row">
                <div class="col-md-12">
                  @can('add plan')
                  <a href="/plans/create" class="btn btn-info float-left">
                                       <i class="fa fa-plus fa-2x"></i> اضافة خطة
                                       
                    </a>
                  @endcan

       </div></div>
      
       @if(count($plans)>0)
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الوصف</th>
                    <th>السعر</th>
                  
                    @can('edit plan')
                    <th>تعديل</th>
                    @endcan
                    @can('delete plan')
                    <th>حذف</th>
                    @endcan

                  </tr>
                </thead>
                <tbody>
                @foreach($plans as $plan)
                 <tr>
                  <td>{{$plan->id}}</td>
                    <td>{{$plan->name}}</td>
                    <td>
                      عدد جهات الاتصال :{{$plan->number_of_contacts }}
                        <br>
                      عدد رسائل الانتظار :{{$plan->add_the_number_of_waiting_messages }}
                    </td>
                    <td>
                          الاشتراك الشهري :{{$plan->monthly_subscription }}
                          <br>
                          الاشتراك السنوي :{{$plan->yearly_subscription }}
                    </td>                  
                      @can('edit plan')
                    <td> 

                      <a href="/plans/{{$plan->id}}/edit" class="btn btn-info float-left">
                                                      <i class="fa fa-edit fa-2x"></i> تعديل
                                                      </a>
                                                      
                                       
                    </td>
                      @endcan
                      @can('delete plan')
                    <td>
                          {!!Form::open(['action' => ['App\Http\Controllers\PlanController@destroy',$plan->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
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
 
 @endsection
       