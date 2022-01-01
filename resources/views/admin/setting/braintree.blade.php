@extends('admin.vadmin.lay')
@section('title') /
 <span class="badge badge-info">

     تعديل  بيانات الدفع :
</span>
@endsection
@section('content')

<div class="md-form text-right text-black col-md-12 card p-2 m-1">
    <h5 class="btn-info p-2">
    تعديل بيانات الدفع : 
    </h5>
 
  <form action="/admin/braintree" method="post" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}
             
        <div class="card mt-4">
            <div class="card-header">
                <h2 class="card-title">Braintree</h2> <br/>
                <div class="fs-12 text-warning">You need Braintree merchant account to integrate Credit Cards or  paypal for your business.</div>
            </div>
            <div class="card-body">
                <label class="label">Braintree ENVIRONMENT</label>
                <input type="hidden" name="types[]" value="BRAINTREE_ENV">
                <select class="form-control" name="BRAINTREE_ENV">
                    <option value="sandbox"
                            @if (env('BRAINTREE_ENV') == "sandbox") selected @endif>
                        Sandbox
                    </option>
                    <option value="production" @if (env('BRAINTREE_ENV') == "production") selected @endif>Production
                    </option>
                </select>

                <label class="label">Braintree MERCHANT ID</label>
                <input type="hidden" name="types[]" value="BRAINTREE_MERCHANT_ID">
                <input type="text" placeholder="Enter the data" value="{{env('BRAINTREE_MERCHANT_ID')}}"
                       name="BRAINTREE_MERCHANT_ID"
                       class="form-control mb-2">

                <label class="label">Braintree PUBLIC KEY</label>
                <input type="hidden" name="types[]" value="BRAINTREE_PUBLIC_KEY">
                <input type="text" placeholder="Enter the data" value="{{env('BRAINTREE_PUBLIC_KEY')}}"
                       name="BRAINTREE_PUBLIC_KEY"
                       class="form-control mb-2">

                <label class="label">BRAINTREE PRIVATE KEY</label>
                <input type="hidden" name="types[]" value="BRAINTREE_PRIVATE_KEY">
                <input type="text" placeholder="Enter the data" value="{{env('BRAINTREE_PRIVATE_KEY')}}"
                       name="BRAINTREE_PRIVATE_KEY"
                       class="form-control mb-2">
            </div>

        </div>
           
           @can('edit settings')
           <div class="form-group">
            {{Form::submit('حفظ التعديلات',['class'=>'btn btn-primary'])}} 
            </div>   
           @endcan
           
   </form>
          
</div>
     
 
   @endsection
