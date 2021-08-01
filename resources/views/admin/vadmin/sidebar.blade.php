
 
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
       
      <ul class="app-menu">

        <li><a class="app-menu__item {{{ (\Request::is('home') ? 'active' : '') }}}" href="/admin/"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">الرئيسة</span></a></li>
      

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
          

     <li class="treeview"><a class="app-menu__item {{{ (Request::is('/basic*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
     </i><span class="app-menu__label">  الشركات </span><i class="treeview-indicator fa fa-angle-left"></i></a>
     <ul class="treeview-menu">
       <li><a class="treeview-item  mr-2" href="#"><i class="icon fa fa-plus-square "></i> إضافة شركة</a></li>
       <li><a class="treeview-item  mr-2" href="#"><i class="icon fa fa-plus-square "></i> الكل</a></li>
       </ul>
     </li>
     
    </li>

        <li class="treeview"><a class="app-menu__item {{{ (Request::is('/basic*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
        </i><span class="app-menu__label">  الصيدليات </span><i class="treeview-indicator fa fa-angle-left"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item  mr-2" href="#"><i class="icon fa fa-plus-square "></i> إضافة صيدلية</a></li>
          <li><a class="treeview-item  mr-2" href="#"><i class="icon fa fa-plus-square "></i> الكل</a></li>
          </ul>
        </li>
        
       </li>
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/basic*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> الاصناف </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="category"><i class="icon fa fa-plus-square "></i> إضافة صنف</a></li>
        <li><a class="treeview-item  mr-2" href="#"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>
      
     </li>
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/basic*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
       </i><span class="app-menu__label">  الادوية </span><i class="treeview-indicator fa fa-angle-left"></i></a>
       <ul class="treeview-menu">
         <li><a class="treeview-item  mr-2" href="#"><i class="icon fa fa-plus-square "></i> إضافة دواء</a></li>
         <li><a class="treeview-item  mr-2" href="#"><i class="icon fa fa-plus-square "></i> الكل</a></li>
         </ul>
       </li>
       
      </li>
          

      <li class="treeview"><a class="app-menu__item {{{ (Request::is('/basic*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> المناديب </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="#"><i class="icon fa fa-plus-square "></i> إضافة مندوب</a></li>
        <li><a class="treeview-item  mr-2" href="#"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>
      
     </li>
          
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('member*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user">
        </i><span class="app-menu__label">  التحكم بالاعضاء</span><i class="treeview-indicator fa fa-angle-left"></i></a>
          <ul class="treeview-menu">
          <li><a class="treeview-item  mr-2" href="#"><i class="icon fa fa-plus-square "></i> الكل</a></li>
            
        </ul>
        </li>
     
        <li class="treeview"><a class="app-menu__item {{{ (Request::is('role*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user">
        </i><span class="app-menu__label">  التحكم بالصلاحيات</span><i class="treeview-indicator fa fa-angle-left"></i></a>
          <ul class="treeview-menu">
          <li><a class="treeview-item  mr-2" href="#"><i class="icon fa fa-plus-square "></i> الكل</a></li>
          </ul>
        </li>

        <li class="treeview"><a class="app-menu__item {{{ (\Request::is('setting/*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">  اعدادت </span><i class="treeview-indicator fa fa-angle-left"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item  mr-2" href="/admin/setting" rel="noopener"><i class="icon fa fa-edit"></i> الموقع</a></li>
            </ul>
        </li>
        
      </ul>
    </aside>