@extends('admin.vadmin.lay')
@section('title') - 
إدارة الصيدليات
@endsection

@section('content')

<div class="container"> 
               
                <div class="container">
                  <div class="row">
                <div class="col-md-12">
                  @can('question-create')

       <a href="" data-toggle="modal" data-target="#add" class="btn btn-info float-left">
                                       <i class="fa fa-plus fa-2x"></i> اضافة صيدلية جديدة
                                       </a>
                                       @endcan

       </div></div>

       {{-- @if(count($Questions)>0) --}}
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>الصيدلية</th>
                    <th>العنوان</th>
                    <th>رقم الطلبية</th>
                    @can('question-edit')
                    <th>تعديل</th>
                    @endcan
                    @can('question-delete')
                    <th>حذف</th>
                    @endcan

                  </tr>
                </thead>
                <tbody>
                @foreach($pharmacies as $pharmacy)
                 <tr>
                   
                    <td>{{$pharmacy->name}}</td>
                    <td>{{$pharmacy->address?$pharmacy->address}}</td>
                    <td>
                       <a  href="" data-toggle="modal" data-target="#edits{{$pharmacy->id}}" class="btn btn-warning mr-3 ml-2">
                        <i class="fa fa-edit fa-2x"></i>
                        </a>
                        
                        
                        

{{-- <div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="edits{{$pharmacy->id}}">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title">  تعديل بيانات النسب  {{$pharmacy->id}}</h5>
       <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
     </div>
     <div class="modal-body">
     {!! Form::open(['action' => ['App\Http\Controllers\admin\pharmacyController@updatespecial',$pharmacy->id], 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
     
     <div class="form-group">

      @php
       $special=\App\Models\special::pluck('name', 'id')->toArray();  
      @endphp
      <div id="repeater">
        <!-- Repeater Heading -->
        <div class="repeater-heading">
            <h5 class="pull-rit"> التخصصات </h5>
            <button type="button" style="float: left !important;font-size: 13px;line-height: 0;border-radius: 3px;padding-top: 15px !important;padding: 16px;" class="btn btn-primary pt-5 repeater-add-btn">
                إضافة
            </button>
        </div>
      <div class="clearfix"></div>
      <!-- Repeater Items -->
      @if(count($pharmacy->rate)>0)
      @foreach($pharmacy->rate as $rat)
      <div class="items" data-group="test">
          <!-- Repeater Content -->
          <div class="item-content">
            <div class="row">
            <div class="form-group col-4 ">
                  {{Form::label('special_id','التخصص  ')}}
                  {{Form::select('special_id', $special,$rat->special_id, ['class' => 'custom-select','id' => 'schoolclass', 'placeholder' => 'اختار اليوم','required'=>true,'data-name'=>"special_id"])}}
                </div>
              <div class="form-group col-4">
                  {{Form::label('rate',' النسبة ')}}
                  {{Form::number('rate',$rat->rate, ['class' => 'form-control','required'=>'required','data-name'=>"rate"])}}
                  </div>
                </div>
          
        </div>
          <!-- Repeater Remove Btn-->
          <div class="pull-left repeater-remove-btn">
              <button type="button" class="btn btn-danger remove-btn">
              إزالة
              </button>
          </div>
          <div class="clearfix"></div>
      </div> 
      @endforeach
      @endif
      <div class="items" data-group="test">
        <!-- Repeater Content -->
        <div class="item-content">
          <div class="row">
            <div class="form-group col-4 ">
                  {{Form::label('special_id','التخصص  ')}}
                  {{Form::select('special_id', $special,null, ['class' => 'custom-select','id' => 'schoolclass', 'placeholder' => 'التخصص','data-name'=>"special_id",'required'=>true])}}
                </div>
          
              <div class="form-group col-4">
                  {{Form::label('rate',' النسبة ')}}
                  {{Form::number('rate', '', ['class' => 'form-control','data-name'=>"rate",'required'=>true])}}
                  </div>
                </div>
        </div>
        <!-- Repeater Remove Btn-->
        <div class="pull-left repeater-remove-btn">
            <button type="button" class="btn btn-danger remove-btn">
            إزالة
            </button>
        </div>
        <div class="clearfix"></div>
      </div> 
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
</div> --}}


                    </td>
                    @can('pharmacy-edit')

                    <td> <a  href="" data-toggle="modal" data-target="#edit{{$pharmacy->id}}" class="btn btn-warning mr-3 ml-2">
                                       <i class="fa fa-edit fa-2x"></i>
                                       </a>
                                       
                                       
                                       

<div class="modal hide fade in " data-keyboard="false" data-backdrop="static" id="edit{{$pharmacy->id}}">
                <div class="modal-dialog" pharmacy="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">  تعديل بيانات الصيدلية {{$pharmacy->id}}</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                    {!! Form::open(['action' => ['App\Http\Controllers\admin\pharmacyController@update',$pharmacy->id], 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
                    
                    <div class="form-group">

            {{Form::label('name','الصيدلية')}}
            {{Form::text('name', $pharmacy->name, ['class' => 'form-control', 'placeholder' => 'السؤال'])}}
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
              @can('question-delete')

              <td>
                    {!!Form::open(['action' => ['App\Http\Controllers\admin\QuestionController@destroy',$Question->id],'method'=>'POST', 'class'=>'pull-right','onsubmit' => 'return ConfirmDelete()'])!!}
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






<!--  data-backdrop="static" id="add" -->


        
        
 
                    
                    <div class="modal-footer">
                      <button class="btn btn-primary" type="submit">  حفظ التعديلات</button>
                      {!! Form::close() !!}      
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">اغلاق</button>
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
       