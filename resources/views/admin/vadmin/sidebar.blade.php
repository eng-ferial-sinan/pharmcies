 
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
       
      <ul class="app-menu">

        <li><a class="app-menu__item {{{ (\Request::is('/') ? 'active' : '') }}}" href="/"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">الرئيسة</span></a></li>
      

{{-- @can('collage-list')

       <li class="treeview"><a class="app-menu__item {{{ (Request::is('collage*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label">  الكليات </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
      @foreach(\App\Models\un_col::all() as $collage)
        <li><a class="treeview-item  mr-2" href="\admin\university\collage\section\{{$collage->id}}" rel="noopener"><i class="icon fa fa-edit"></i> {{$collage->university?$collage->university->name:"لايوجد"}}>>{{$collage->collage?$collage->collage->name:"لايرجد"}}</a></li>
        @endforeach
        
      </ul>
      </li>
      
     </li>
     @endcan --}}
          

    
       @if (auth()->user()->hasPermission('Pharmacy-list'))
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/basic*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label">  الصيدليات </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/pharmacy/create"><i class="icon fa fa-plus-square "></i> إضافة صيدلية</a></li>
        <li><a class="treeview-item  mr-2" href="/pharmacy"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>
       @endif
      
        
       </li>
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/basic*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> الاصناف </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        {{-- <li><a class="treeview-item  mr-2" href="/category/create"><i class="icon fa fa-plus-square "></i> إضافة صنف</a></li> --}}
        <li><a class="treeview-item  mr-2" href="/category"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>
      
     </li>
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/basic*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
       </i><span class="app-menu__label">  الادوية </span><i class="treeview-indicator fa fa-angle-left"></i></a>
       <ul class="treeview-menu">
         <li><a class="treeview-item  mr-2" href="/medicine"><i class="icon fa fa-plus-square "></i> الكل</a></li>
         </ul>
       </li>
       
      </li>
      <li class="treeview"><a class="app-menu__item {{{ (Request::is('/basic*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> طلبيات </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        {{-- <li><a class="treeview-item  mr-2" href="order"><i class="icon fa fa-plus-square "></i> إضافة طلبية</a></li> --}}
        <li><a class="treeview-item  mr-2" href="/order"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>
      
     </li>      

      {{-- <li class="treeview"><a class="app-menu__item {{{ (Request::is('/basic*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> المناديب </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="#"><i class="icon fa fa-plus-square "></i> إضافة مندوب</a></li>
        <li><a class="treeview-item  mr-2" href="#"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>
      
     </li> --}}
     <li class="treeview"><a class="app-menu__item {{{ (Request::is('member*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user">
    </i><span class="app-menu__label">  التحكم بالاعضاء</span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
      <li><a class="treeview-item  mr-2" href="/member"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        
    </ul>
    </li>

        {{-- @can('user-list')
        <li class="treeview"><a class="app-menu__item {{{ (Request::is('admin/member*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user">
         </i><span class="app-menu__label">  التحكم بالاعضاء</span><i class="treeview-indicator fa fa-angle-left"></i></a>
           <ul class="treeview-menu">
           <li><a class="treeview-item  mr-2" href="/admin/members/0"><i class="icon fa fa-plus-square "></i> الكل</a></li>
 
           @foreach(\Spatie\Permission\Models\Role::orderBy('name','asc')->get() as $type)
              <li><a class="treeview-item  mr-2" href="/admin/members/{{$type->id}}" rel="noopener"><i class="icon fa fa-edit"></i> {{$type->name}}</a></li>
              @endforeach
 
           </ul>
         </li>
          @endcan --}}
        {{-- @can('user-list')

        <li>
         <a href="#"><i class="fa fa-users fa-fw"></i> المستخدمين<span class="fa arrow"></span></a>
         <ul class="nav nav-second-level">
           
             <li><a  href="/admin/member"><i class="icon fa fa-plus"></i> الكل</a></li>
           @foreach(\Spatie\Permission\Models\permission::orderBy('name','asc')->get() as $type)
           <li>
                 <a href="/admin/members/{{$type->id}}"><i class="icon fa fa-plus"></i> {{$type->name}}</a>
             </li>
            @endforeach
         </ul>
         <!-- /.nav-second-level -->
     </li>
     @endcan    --}}
     

        <li class="treeview"><a class="app-menu__item {{{ (\Request::is('setting/*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">  اعدادت </span><i class="treeview-indicator fa fa-angle-left"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item  mr-2" href="/setting" rel="noopener"><i class="icon fa fa-edit"></i> الموقع</a></li>
            </ul>
        </li>
        
      </ul>
    </aside>