@extends('admin.vadmin.lay')
@section('title') - 
إدارة  المنتجات
@endsection

@section('content')

   <div class="container"> 
               
            <div class="row">
              <div class="col-md-12">
              </div>
            </div>
      
       @if(count($contacts)>0)
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered " id="sampleTable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>الموضوع</th>
                    <th>عرض التفاصيل</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                 <tr>
                  <td>{{$contact->id}}</td>
                    <td>{{$contact->first_name}}</td>
                    <td>{{$contact->subject}}</td>
                    
                    <td> 

                      <a href="/admin/contact/{{$contact->id}}" class="btn btn-info float-left">
                      <i class="fa fa-eye fa-2x"></i> 
                      </a>
                                                      
                                       
                    </td>
              
                    
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
       