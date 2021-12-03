@extends('admin.vadmin.lay')

@section('head')   /
بيانات   المنتجات

@endsection

@section('content')

  <div class="tile ">

      <div class="panel panel-default">
    
          <div class="panel-heading">
            عرض    
            بيانات   
          {{$item->name }}  
           </div>

  
    
          <div class="panel-body">     
              <div class="row">
                    <div class="col-md-6">   
                        <div class=" form-group">
                          {{Form::label('first_name','الاسم ')}}
                          {{Form::text('first_name', $item->first_name , ['class' => 'form-control', 'readOnly'=>true])}}
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group">
                          {{Form::label('last_name','اللقب ')}}
                          {{Form::text('last_name', $item->last_name , ['class' => 'form-control', 'readOnly'=>true])}}
                        </div>
                    </div>
              </div> 

              <div class="form-group">
                {{Form::label('email','البريد الالكتروني ')}}
                {{Form::text('email', $item->email , ['class' => 'form-control', 'readOnly'=>true])}}
              </div>
              <div class="form-group">
                {{Form::label('subject','الموضوع ')}}
                {{Form::text('subject', $item->subject , ['class' => 'form-control', 'readOnly'=>true])}}
              </div>
              <div class="form-group">
                {{Form::label('message','الرسالة ')}}
                {{Form::textarea('message', $item->message , ['class' => 'form-control', 'readOnly'=>true])}}
                {{-- <textarea name="" id="" cols="30" rows="10"></textarea> --}}
              </div>
        
        </div>
        <div class="modal-footer justify-content-between">
              <a href="\admin\contact" class="btn btn-default" data-dismiss="modal">الغاء</a>
        </div>
      </div>
  </div>
    
   @endsection
