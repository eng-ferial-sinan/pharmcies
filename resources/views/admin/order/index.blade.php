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

       @if(count($orders)>0)
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>رقم الطلبية</th>
                    <th>الزبون </th>
                    <th>الصيدلية </th>
                    <th>المندوب </th>
                    <th>حالة الطلبية</th>
                  
                    <th>عرض</th>
                    @if (auth()->user()->hasPermission('order-delete'))
                    <th>-</th>
                    @endif
                    {{-- @endcan --}}

                  </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                 <tr>
                   
                    <td>{{$order->id}}</td>
                    {{-- <td>{{$order->pharmacy_id}}</td> --}}
                    <td>{{$order->pharmacy?($order->pharmacy->user?$order->pharmacy->user->name:"-"):"-"}}</td>
                    <td>{{$order->pharmacy?$order->pharmacy->name:""}}</td>
                    <td>{{$order->user?$order->user->name:"لم يتم تعين مندوب بعد"}}</td>
                    <td>{{$order->status?$order->status->name:""}}</td>

              <td>
              <a href="\order\{{$order->id}}" class="btn btn-success ">
              <i class="fa fa-eye"></i></a>
                    </td>
                    @if (auth()->user()->hasPermission('order-delete'))
              <td>
                    {!!Form::open(['action' => ['App\Http\Controllers\OrderController@destroy',$order->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                    {{Form::hidden('_method','DELETE')}}
                       <button class ="btn btn-danger mr-3 ml-3" type="submit"><i class="fa fa-md fa-trash"></i>
                       </button>
                       {!!Form::close()!!}
                    </td>
                    @endif
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