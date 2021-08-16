@extends('admin.vadmin.lay')
@section('title') - 
إدارة الادوية
@endsection

@section('content')

<div class="container"> 
               
                  <div class="row">
                <div class="col-md-12">
                  @if (auth()->user()->hasPermission('medicine-create'))
       <a href="/medicine/create" class="btn btn-info float-left">
                                       <i class="fa fa-plus fa-2x"></i> اضافة دواء
                                       </a>
                      @endif

       </div></div>
      
       @if(count($medicines)>0)
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
                    <th>تاريخ الانتاج</th>
                    <th>تاريخ الانتهاء</th>
                    @if (auth()->user()->hasPermission('medicine-edit'))
                    <th>تعديل</th>
                    @endif
                    @if (auth()->user()->hasPermission('medicine-delete'))
                    <th>حذف</th>
                    @endif

                  </tr>
                </thead>
                <tbody>
                @foreach($medicines as $medicine)
                 <tr>
                  <td>{{$medicine->id}}</td>
                  <td><img src="{{$medicine->image}}" height="80" width="75"></td>
                    <td>{{$medicine->name}}</td>
                    <td>{{$medicine->category?$medicine->category->name:''}}</td>
                    <td>{{$medicine->price}}</td>
                    <td>{{$medicine->production_date}}</td>
                    <td>{{$medicine->expiry_date}}</td>

                    <td> 
                       @if (auth()->user()->hasPermission('medicine-edit'))

                      <a href="/medicine/{{$medicine->id}}/edit" class="btn btn-info float-left">
                                                      <i class="fa fa-edit fa-2x"></i> تعديل
                                                      </a>
                                                      @endif
                                       
                                                    </td>

              @if (auth()->user()->hasPermission('medicine-delete'))
              <td>
                    {!!Form::open(['action' => ['App\Http\Controllers\MedicineController@destroy',$medicine->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
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
@section('script')
<script src="/js/repeater.js" type="text/javascript"></script>
    <script>
        /* Create Repeater */
        $("#repeater").createRepeater({
            showFirstItemToDefault: true,
        });
    </script>
 
 @endsection
       