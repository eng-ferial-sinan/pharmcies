
@if(count($errors)>0)
    @foreach($errors->all() as $error)
    <div class="{{{ (Request::is('admin/*') ? '' : 'pt-5 mt-3') }}} ">

        <div class="alert alert-danger   text-center">
        {{$error}}
        </div>
        </div>
    @endforeach
@endif

@if(session('success'))
<div class="{{{ (Request::is('admin/*') ? '' : 'pt-5 mt-3') }}} ">

    <div class="alert alert-success  text-center">
        {{session('success')}}
    </div>
    </div>
@endif

@if(session('error'))
<div class="{{{ (Request::is('admin/*') ? '' : 'pt-5 mt-3') }}} ">

    <div class="alert alert-danger  text-center">
        {{session('error')}}
    </div>
    </div>
@endif
 