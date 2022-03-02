@extends('admin.vadmin.lay')
@section('title') - 
إدارة الطلبيات
@endsection

@section('content')

<div class="container"> 
               
                <div class="container">
                  <div class="row">
                <div class="col-md-12">


       </div></div>

       @if(count($reservations)>0)
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-breservationed " id="sampleTable">
                <thead>
                  <tr>
                    <th>رقم الطلبية</th>
                    <th>طريقة الدفع </th>
                    <th>الزبون </th>
                    <th>الخدمة </th>
                    <th>السعر </th>
                    <th>الصالون </th>
                    <th> تاريخ الحجز</th>
                    <th> وقت الحجز</th>
                  
                    {{-- <th>عرض</th> --}}
                    @can ('edit reservation')
                    <th>-</th>
                    @endcan
                    {{-- @endcan --}}

                  </tr>
                </thead>
                <tbody>
                @foreach($reservations as $reservation)
                 <tr>
                   
                    <td>{{$reservation->id}}</td>
                    <td>{{$reservation->paymentMethod?$reservation->paymentMethod->name:'-'}}</td>
                    <td>{{$reservation->user?$reservation->user->name:"-"}}</td>
                    <td>{{$reservation->service?$reservation->service->name:"لم يتم تعين سائق بعد"}}</td>
                    <td>{{$reservation->price}}</td>
                    <td>{{$reservation->salon?$reservation->salon->name:"لم يتم تعين سائق بعد"}}</td>
                    <td>{{$reservation->date}}</td>
                    <td>{{$reservation->time}}</td>

              {{-- <td>
              <a href="\admin\reservation\{{$reservation->id}}" class="btn btn-success ">
              <i class="fa fa-eye"></i></a>
                    </td> --}}
                    @can ('delete reservation')
                    <td>
                          {!!Form::open(['action' => ['App\Http\Controllers\ReservationController@destroy',$reservation->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
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