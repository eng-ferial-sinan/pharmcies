@extends('admin.vadmin.lay')

@section('head')   /
بيانات   
    الاصناف

@endsection


@section('content')

 


    <div class="row">
        <div class="col-md-12  " style="text-align: center;">
                @can('category-create')
                <h3>
                <a href="/category/create" class="btn btn-primary">اضافة صنف جديد </a>
                </h3>
            @endcan

    </div>
</div>

 <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            {{-- <div class="panel-heading">
                DataTables Advanced Tables
            </div> --}}
            <!-- /.panel-heading -->
            <div class="panel-body">
                {{-- <div class="table-responsive"> --}}
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                       <tr>
                    <th>#</th>
                    <th>الصنف</th>
                    {{-- <th>البيانات </th> --}}
                    @can('category-edit')
                    <th>-</th>
                    @endcan

                    @can('category-delete')
                    <th>-</th>
                    @endcan
                </tr>
                </thead>
                <tbody>  
                    @foreach($categorys as $category)
                    <tr>
                    <td>{{$category->id}} </td>
                    <td>{{$category->name}}</a></td>
                
                    {{-- @can('category-edit') --}}
                    <td>
                        <a href="/category/{{$category->id}}/edit" class="btn btn-default">
                        <i class="fa fa-edit"></i>
                        التحرير</a>
                    </td>
                     
                    {{-- @endcan --}}
                    
                
                    {{-- @can('category-delete') --}}
                    <td>

 
                        {!!Form::open(['action' => ['App\Http\Controllers\CategoryController@destroy',$category->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('الحذف',['class'=>'btn btn-danger'])}}
                        {!!Form::close()!!}
                       
                        
                    </td>
                    {{-- @endcan --}}
      
                </tr>
                    @endforeach 
                
                    </tbody>

                </table>
        </div>
    </div>
</div>
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
