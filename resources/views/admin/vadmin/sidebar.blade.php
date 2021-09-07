 
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
       
      <ul class="app-menu">

        <li><a class="app-menu__item {{{ (\Request::is('/') ? 'active' : '') }}}" href="/"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">الرئيسة</span></a></li>
    
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
        <li><a class="treeview-item  mr-2" href="/category"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>
      
     </li>
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/basic*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
       </i><span class="app-menu__label">  الادوية </span><i class="treeview-indicator fa fa-angle-left"></i></a>
       <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/medicine/create"><i class="icon fa fa-plus-square "></i> إضافة دواء</a></li>
         <li><a class="treeview-item  mr-2" href="/medicine"><i class="icon fa fa-plus-square "></i> الكل</a></li>
         </ul>
       </li>
       
      </li>
      <li class="treeview"><a class="app-menu__item {{{ (Request::is('/visit*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> الزيارات للصيدليات </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/visit"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>

      <li class="treeview"><a class="app-menu__item {{{ (Request::is('/basic*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> طلبيات </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        {{-- <li><a class="treeview-item  mr-2" href="order"><i class="icon fa fa-plus-square "></i> إضافة طلبية</a></li> --}}
        <li><a class="treeview-item  mr-2" href="/order"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>
      
     </li>      

      <li class="treeview"><a class="app-menu__item {{{ (Request::is('/basic*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> التقارير </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/reports"><i class="icon fa fa-plus-square "></i> صيدليات</a></li>
        <li><a class="treeview-item  mr-2" href="/reports/representative"><i class="icon fa fa-plus-square "></i> المناديب</a></li>
        </ul>
      </li>
     </li>
     <li class="treeview"><a class="app-menu__item {{{ (Request::is('member*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user">
    </i><span class="app-menu__label">  التحكم بالاعضاء</span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
      <li><a class="treeview-item  mr-2" href="/member"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        
    </ul>
    </li>
   <li class="treeview"><a class="app-menu__item {{{ (\Request::is('setting/*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">  اعدادت </span><i class="treeview-indicator fa fa-angle-left"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item  mr-2" href="/setting" rel="noopener"><i class="icon fa fa-edit"></i> الموقع</a></li>
            </ul>
        </li>
        
      </ul>
    </aside>