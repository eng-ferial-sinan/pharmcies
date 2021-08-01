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
    case "special-list": $name = " عرض التخصصات";break;
    case "special-create": $name = "انشاءالتخصصات ";break;
    case "special-edit": $name = "تعديل التخصصات";break;
    case "special-delete": $name = "حذف التخصصات";break;
    case "collage-list": $name = "عرض الكليات";break;
    case "collage-create": $name = "اضافة الكليات ";break;
    case "collage-edit": $name = "تعديل الكليات";break;
    case "collage-delete": $name = "حذف الكليات";break;
    case "university-list": $name = "عرض الجامعة";break;
    case "university-create": $name = "انشاءالجامعة ";break;
    case "university-edit": $name = "تعديل الجامعة";break;
    case "university-delete": $name = "حذف الجامعة";break;
    case "question-list": $name = "عرض الاسئلة";break;
    case "question-create": $name = "انشاءالاسئلة ";break;
    case "question-edit": $name = "تعديل الاسئلة";break;
    case "question-delete": $name = "حذف الاسئلة";break;
    case "subject-list": $name = "عرض المواد";break;
    case "subject-create": $name = "انشاءالمواد ";break;
    case "subject-edit": $name = "تعديل المواد";break;
    case "subject-delete": $name = "حذف المواد";break;
    case "student-create": $name = "انشاء حساب طالب ";break;

}

        return  $name;
   
    }
@endphp

<div class="container"> 
               
                <div class="container">
                <div class="row">
                <div class="col-md-12">

                  @can('role-create')

       <a href="" data-toggle="modal" data-target="#add" class="btn btn-info float-left">
                                       <i class="fa fa-plus fa-2x"></i> اضافة نوع جديد 
                        
                                </a>
                                @endcan
           
       </div></div>
       
       @if(count($roles)>0)
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>الاسم</th>
                    <th>الصلاحيات</th>
                    @can('role-edit')
                    <th>-</th>
                    @endcan
                    @can('role-delete')
                    <th>-</th>
                    @endcan

                   </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                  <tr>
                    <td>{{$role->name}}</td>
                  
                    <td>
                        <?php
                        $rolePermissions = \Spatie\Permission\Models\Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$role->id)
            ->get();
            ?>
                  @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $Permission)
                            <label class="  badge-success btn btn-success " >{{roleName1($Permission->name)  }},</label>
                        @endforeach
                    @endif
                     </td>
                     @can('role-edit')

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
                    {!! Form::open(['action' => ['App\Http\Controllers\Admin\RoleController@update',$role->id], 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                    <div class="form-group">
                        {!! Form::text('name', $role->name, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
<?php
          $permission = \Spatie\Permission\Models\Permission::all();
        $rolePermissions = \DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
           ->all();
       ?>
        @foreach($permission as $value)
        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
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
                @endcan


                @can('role-delete')
                    <td>
                    {!!Form::open(['action' => ['App\Http\Controllers\Admin\RoleController@destroy',$role->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
                    {{Form::hidden('_method','DELETE')}}
                       <button class ="btn btn-danger mr-3 ml-3" type="submit"><i class="fa fa-md fa-trash"></i>
                       </button>
                       {!!Form::close()!!}</td>
                       @endcan

                  </tr>
                   
                   
                  @endforeach
                   
                   

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
 
                    @else
                        <p> لا توجد بيانات حالياً</p>
                    @endif
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
                    {!! Form::open(['action' => 'App\Http\Controllers\Admin\RoleController@store', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
            
                    <div class="form-group">
                        {!! Form::text('name', null, array('placeholder' => 'الاسم','class' => 'form-control')) !!}
                    </div>
        <div class="form-group">
            
            <?php
            $permission = \Spatie\Permission\Models\Permission::where('id','!=',18)->get();

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