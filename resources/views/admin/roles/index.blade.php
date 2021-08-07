@extends('admin.vadmin.lay')
@section('title') - 
انواع المستخدمين
@endsection

@section('content')
@php
   function roleName1($name)
    {
         
switch($name)
{
    case "role-list": $name = "عرض انواع المستخدمين"; break;
    case "role-create": $name = "انشاء نوع جديد";break;
    case "role-edit": $name = "تعديل نوع المستخدم  ";break;
    case "role-delete": $name = "حذف نوع";break;
    case "user-list": $name = "عرض  المستخدمين"; break;
    case "user-create": $name = "انشاء مستخدم جديد";break;
    case "user-edit": $name = "تعديل  المستخدم  ";break;
    case "user-delete": $name = "حذف المستخدم";break;
    
}

        return  $name;
   
    }
@endphp

<div class="container"> 
               
                <div class="container">
                <div class="row">
                <div class="col-md-12">

                  {{-- @can('role-create') --}}

       <a href="" data-toggle="modal" data-target="#add" class="btn btn-info float-left">
                                       <i class="fa fa-plus fa-2x"></i> اضافة نوع جديد 
                        
                                </a>
                                {{-- @endcan --}}
           
       </div></div>
       
       {{-- @if(count($roles)>0) --}}
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>الاسم</th>
                    <th>الصلاحيات</th>
                    {{-- @can('role-edit') --}}
                    <th>-</th>
                    {{-- @endcan --}}
                    {{-- @can('role-delete') --}}
                    <th>-</th>
                    {{-- @endcan --}}

                   </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                  <tr>
                    <td>{{$permission->name}}</td>
                  
                    <td>
                        <?php
                        $Permissions = App\Models\Permission::join("Permission","Permission.permission_id","=","permissions.id")
            ->where("Permission.user_id",$user->id)
            ->get();
            ?>
                  @if(!empty($Permissions))
                        @foreach($Permissions as $Permission)
                            <label class="  badge-success btn btn-success " >{{roleName1($Permission->name)  }},</label>
                        @endforeach
                    @endif
                     </td>
                     {{-- @can('role-edit') --}}

            <td> 
              <a  href="" data-toggle="modal" data-target="#edit{{$role->id}}" class="btn btn-warning mr-3 ml-2">
                                       <i class="fa fa-edit fa-2x"></i>
                                       </a>
                                       
                                       

<div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="edit{{$role->id}}">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">  تعديل بيانات  {{$role->name}}</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                    {!! Form::open(['action' => ['App\Http\Controllers\PermissionController@update',$role->id], 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                    <div class="form-group">
                        {!! Form::text('name', $role->name, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
<?php
          $permission =  App\Models\Permission::all();
        $Permissions = \DB::table("permissions")->where("permissions.user_id",$user->id)
            ->pluck('permissions.permission_id','permissions.permission_id')
           ->all();
       ?>
        @foreach($permission as $value)
        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $Permissions) ? true : false, array('class' => 'name')) }}
            {{roleName1($value->name)  }}</label>

            @endforeach
        </div>

  
            {{Form::hidden('_method','PUT')}}
        
         </div>
                    <div class="modal-footer">
                      <button class="btn btn-primary" type="submit">  حفظ التعديلات</button>
                      {!! Form::close() !!}      
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">اغلاق</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             
                </td>
                {{-- @endcan --}}


                {{-- @can('role-delete') --}}
                    <td>
                    {!!Form::open(['action' => ['App\Http\Controllers\PermissionController@destroy',$role->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                    {{Form::hidden('_method','DELETE')}}
                       <button class ="btn btn-danger mr-3 ml-3" type="submit"><i class="fa fa-md fa-trash"></i>
                       </button>
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
 
                    {{-- @else
                        <p> لا توجد بيانات حالياً</p>
                    @endif --}}
        </div>






<!--  data-backdrop="static" id="add" -->


<div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="add">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">  اضافة نوع مستخدم  جديد</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                    {!! Form::open(['action' => 'App\Http\Controllers\PermissionController@store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
            
                    <div class="form-group">
                        {!! Form::text('name', null, array('placeholder' => 'الاسم','class' => 'form-control')) !!}
                    </div>
        <div class="form-group">
            
            <?php
            $permission = App\Models\Permission::where('id','!=',18)->get();

        ?>
            @foreach($permission as $value)
            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                {{roleName1($value->name)  }}</label>
        <br/>
        
        @endforeach
    </div>
        
        
      
    
                     </div>
                    <div class="modal-footer">
                      <button class="btn btn-primary" type="submit">  حفظ التعديلات</button>
                      {!! Form::close() !!}      
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">اغلاق</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
@endsection