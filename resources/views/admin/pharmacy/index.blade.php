@extends('admin.vadmin.lay')
@section('title') - 
إدارة الصيدليات
@endsection

@section('content')

<div class="container"> 
               
                <div class="container">
                  <div class="row">
                <div class="col-md-12">
                  {{-- @can('pharmacy-create') --}}
                  @if (auth()->user()->hasPermission('pharmacy-create'))

       <a href="/pharmacy/create" class="btn btn-info float-left">
                                       <i class="fa fa-plus fa-2x"></i> اضافة صيدلية جديدة
                                       </a>
                                       @endif
                                       {{-- @endcan --}}

       </div></div>

       @if(count($pharmacies)>0)
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
                    <th>الصيدلية</th>
                    <th>العنوان</th>
                    <th>عدد الطلبات</th>
                    <th>ملاحظات </th>
              @if (auth()->user()->hasPermission('pharmacy-edit'))
                    
                    <th>تعديل</th>
                    @endif
              @if (auth()->user()->hasPermission('pharmacy-delete'))

                    <th>حذف</th>
                    @endif

                  </tr>
                </thead>
                <tbody>
                @foreach($pharmacies as $pharmacy)
                 <tr>
                  <td>{{$pharmacy->id}} </td>
                  <td><img src="{{$pharmacy->image}}" height="80" width="75"></td>
                    <td>{{$pharmacy->name}}</td>
                    <td>{{$pharmacy->address}}</td>
                    <td>
                      {{$pharmacy->order_count}}
                       {{-- <a  href="" data-toggle="modal" data-target="#edits{{$pharmacy->id}}" class="btn btn-warning mr-3 ml-2">
                        <i class="fa fa-edit fa-2x"></i>
                        </a> --}}
                    </td>
                    <td>{{$pharmacy->note}}</td>

                    <td>
                      @if (auth()->user()->hasPermission('pharmacy-create'))

       <a href="/pharmacy/{{$pharmacy->id}}/edit" class="btn btn-info float-left">
                                       <i class="fa fa-edit fa-2x"></i> تعديل
                                       </a>
                                       @endif
              </td>
            
              <td>
                    {!!Form::open(['action' => ['App\Http\Controllers\PharmacyController@destroy',$pharmacy->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                    {{Form::hidden('_method','DELETE')}}
                       <button class ="btn btn-danger mr-3 ml-3" type="submit"><i class="fa fa-md fa-trash"></i>
                       </button>
                       {!!Form::close()!!}
                    </td>
                      

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
       