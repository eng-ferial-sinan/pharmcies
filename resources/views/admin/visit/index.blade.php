@extends('admin.vadmin.lay')
@section('title') - 
إدارة زيارات المناديب
@endsection

@section('content')

<div class="container"> 
               
                <div class="container">
                  <div class="row">
                <div class="col-md-12">


       </div></div>

       @if(count($visits)>0)
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>المندوب </th>
                    <th>الصيدلية </th>
                    <th>التاريخ </th>
                    <th> # </th>
                    {{-- @endcan --}}

                  </tr>
                </thead>
                <tbody>
                @foreach($visits as $visit)
                 <tr>
                   
                    <td>{{$visit->id}}</td>
                    <td>{{$visit->user?$visit->user->name:"-"}}</td>
                    <td>{{$visit->pharmacy?$visit->pharmacy->name:""}}</td>
                    <td>{{$visit->created_at->format('Y-m-d')}}</td>
                    <td>{{$visit->created_at->diffForHumans()}}</td>
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