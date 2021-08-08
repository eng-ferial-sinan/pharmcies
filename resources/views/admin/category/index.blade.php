@extends('admin.vadmin.lay')

@section('head')   /
بيانات   
    الاصناف

@endsection


@section('content')

<div class="container"> 


    <div class="row">
        <div class="col-md-12  " style="text-align: center;">
                @can('category-create')
                <h3>
                <a href="/category/create" class="btn btn-primary">اضافة صنف جديد </a>
                </h3>
            @endcan

    </div>
</div>

@if(count($categorys)>0)
<div class="row">
 <div class="col-md-12">
   <div class="tile">
     <div class="tile-body">
       <div class="table-responsive">
       <table class="table table-hover table-bordered " id="sampleTable">
                        <thead>
                       <tr>
                    <th>#</th>
                    <th>الصنف</th>
                    {{-- <th>البيانات </th> --}}
                    {{-- @can('category-edit') --}}
                    {{-- @if (auth()->user()->hasPermission('category-edit')) --}}

                    <th>-</th>
                    {{-- @endif --}}

                    {{-- @endcan --}}
                    {{-- @if (auth()->user()->hasPermission('category-delete')) --}}
                    {{-- @can('category-delete') --}}
                    <th>-</th>
                    {{-- @endif --}}
                    {{-- @endcan --}}
                </tr>
                </thead>
                <tbody>  
                    @foreach($categorys as $category)
                    <tr>
                    <td>{{$category->id}} </td>
                    <td>{{$category->name}}</a></td>

                    {{-- @if (auth()->user()->hasPermission('category-edit')) --}}
            
                    {{-- @can('category-edit') --}}
                    <td>
                        <a href="/category/{{$category->id}}/edit" class="btn btn-default">
                        <i class="fa fa-edit"></i>
                        التحرير</a>
                    </td>
                    {{-- @endif --}}
                     
                    {{-- @endcan --}}
                    
                    {{-- @if (auth()->user()->hasPermission('category-delete')) --}}
                
                    {{-- @can('category-delete') --}}
                    <td>

 
                        {!!Form::open(['action' => ['App\Http\Controllers\CategoryController@destroy',$category->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('الحذف',['class'=>'btn btn-danger'])}}
                        {!!Form::close()!!}
                       
                        
                    </td>
                    {{-- @endif --}}

                    {{-- @endcan --}}
      
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
    

<script>      
    function ConfirmDelete( )
    {
       var msg = "هل تريد فعلاً   حذف  "+"?";
    var x = confirm(    msg);
    if (x)
      return true;
    else
      return false;
    }
  
</script>
@endsection
