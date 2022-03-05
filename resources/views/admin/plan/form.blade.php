@extends('admin.vadmin.lay')

@section('head')   /
بيانات   المنتجات

@endsection

@section('content')

<div class="tile ">

<div class="panel panel-default">
    @if ($item->id == null)
    <div class="panel-heading">
    اضافة   
    بيانات   
  </div>
  @else 
  <div class="panel-heading">
    تحرير   
    بيانات   
  {{$item->name }}  
</div>

  @endif
    
  <div class="panel-body">     
        <form method="post" action="@if ($item->id == null) {{ route('plans.store') }} @else {{ route('plans.update', ['plan' => $item->id]) }} @endif" enctype="multipart/form-data">
        {{ csrf_field() }}
        @if ($item->id != null)
            {{ method_field('PUT') }}
        @endif       
        <div class="form-group">
        {{Form::label('name','اسم المنتج')}}
        {{Form::text('name', $item->name , ['class' => 'form-control', 'placeholder' => 'الاسم','required'=>true])}}
        </div>
        
        
        </select>
        {{-- {!! Form::select('category_id', $categories,null, array('class' => 'form-control')) !!} --}}
        </div>
        
        <div class="form-group">
        {{Form::label('number_of_contacts',' عدد جهات الاتصال')}}
        {{Form::number('number_of_contacts',$item->number_of_contacts, ['class' => 'form-control', 'placeholder' => 'عدد جهات الاتصال','required'=>true])}}
        </div>
        <div class="form-group">
          {{Form::label('add_the_number_of_waiting_messages',' عدد رسائل الانتظار')}}
          {{Form::number('add_the_number_of_waiting_messages',$item->add_the_number_of_waiting_messages, ['class' => 'form-control', 'placeholder' => 'عدد رسائل الانتظار','required'=>true])}}
        </div>
        <div class="form-group">
            {{Form::label('monthly_subscription',' سعر الاشتراك الشهري')}}
            {{Form::number('monthly_subscription',$item->monthly_subscription, ['class' => 'form-control', 'placeholder' => 'سعر الاشتراك الشهري','required'=>true])}}
        </div>
        <div class="form-group">
          {{Form::label('yearly_subscription',' سعر الاشتراك السنوي')}}
          {{Form::number('yearly_subscription',$item->yearly_subscription, ['class' => 'form-control', 'placeholder' => 'سعر الاشتراك السنوي','required'=>true])}}
          </div>
                 </div>
              <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">حفظ </button>
                <a href="\plans" class="btn btn-default" data-dismiss="modal">الغاء</a>
              </div>
        </form>
      </div>
</div>

    
      @endsection
