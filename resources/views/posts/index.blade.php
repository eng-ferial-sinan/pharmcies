@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <p> index post form</p>
           <label> title</label>
           <input type="text" name="text1"><br>
           <p>body</p>
           <input type="text" name="text2"><br>
           <button type="submit" class="btn btn-primary"></button>
        </div>
    </div>
</div>
@endsection
