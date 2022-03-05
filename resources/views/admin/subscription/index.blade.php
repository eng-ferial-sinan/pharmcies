@extends('admin.vadmin.lay')
@section('title') - 
إدارة الاشتراكات
@endsection

@section('content')

<div class="container"> 
               
                <div class="container">
                  <div class="row">
                <div class="col-md-12">


       </div></div>

       @if(count($subscriptions)>0)
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>الرقم </th>
                    <th>طريقة الدفع </th>
                    <th>الزبون </th>
                    <th>السائق </th>
                    <th>حالة الاشتراك</th>
                      @can ('edit order')
                    <th>-</th>
                    @endcan
                    {{-- @endcan --}}

                  </tr>
                </thead>
                <tbody>
                @foreach($subscriptions as $subscription)
                 <tr>
                   
                    <td>{{$subscription->id}}</td>
                    <td>{{$subscription->plan?$subscription->plan->name:'-'}}</td>
                    <td>{{$subscription->user?$subscription->user->name:"-"}}</td>
                    <td>{{$subscription->payment?$subscription->payment->name:"لم يتم تعين سائق بعد"}}</td>
                    <td>{{$subscription->status?"مدفوع":"غير مدفوع"}}</td>
                        @can ('edit subscription')
                    <td>
                        {!!Form::open(['action' => ['App\Http\Controllers\OrderController@destroy',$order->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
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