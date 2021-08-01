
@extends('admin.vadmin.lay')

@section('title')
/
<span>بيانات   
الاعضاء
 </span>
 @endsection
@section('content')

 


<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2 dir_rtl" style="text-align: center;">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                @can('user-create')
                <div class="panel-body" >
                <h3>
                <a href="/admin/member/create" class="btn btn-primary">انشاء 
                 عضو</a>
                </h3>
            </div>
            @endcan

        </div>
    </div>
</div>

 <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
                    <tr>
                    <th>ID</th>
                    <th>الاسم</th>
                    <th>البيانات </th>
                    @can('user-edit')
                    <th>-</th>
                    @endcan

                    @can('user-delete')
                    <th>-</th>
                    @endcan
                </tr>
                </thead>
                <tbody>  
                    @foreach($users as $user)
                    <tr>
                    <td>{{$user->id}} </td>
                    <td><a href="/users/{{$user->id}}/" class="btn btn-default">{{$user->name}}</a></td>
                    <td><a href="/users/{{$user->id}}/" class="btn btn-default">{{$user->email}}
                    <br> {{$user->market}}</a></td>
                    @can('user-edit')
                    <td>
                        <a href="/admin/member/{{$user->id}}/edit" class="btn btn-default">
                        <i class="fa fa-edit"></i>
                        التحرير</a>
                    </td>
                     
                    @endcan
                    
                
                    @can('user-edit')
                    <td>

                         @if(!is_null($user->deleted_at))                        
                       
                        {!!Form::open(['action' => ['App\Http\Controllers\admin\UserController@restorUser',$user->id],'method'=>'GET', 'class'=>'pull-right' ])!!}
                        {{Form::hidden('_method','GET')}}
                        {{Form::submit(' إستعادة',['class'=>'btn btn-info'])}}
                        {!!Form::close()!!}
                        <br>
                        {!!Form::open(['action' => ['App\Http\Controllers\admin\UserController@froceDestroy',$user->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('حذف نهائي ',['class'=>'btn btn-danger'])}}
                        {!!Form::close()!!}
                       
                        @else 
                        {!!Form::open(['action' => ['App\Http\Controllers\admin\UserController@destroy',$user->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('الحذف',['class'=>'btn btn-danger'])}}
                        {!!Form::close()!!}
                       
                        @endif
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
