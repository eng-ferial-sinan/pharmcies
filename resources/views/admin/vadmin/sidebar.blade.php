 
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
       
      <ul class="app-menu">

        <li><a class="app-menu__item {{{ (\Request::is('/') ? 'active' : '') }}}" href="/"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">الرئيسة</span></a></li>
            
       </li>
      @can('list plans')
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/plan*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
       </i><span class="app-menu__label">  الخطط </span><i class="treeview-indicator fa fa-angle-left"></i></a>
       <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/plans/create"><i class="icon fa fa-plus-square "></i> إضافة خطة</a></li>
         <li><a class="treeview-item  mr-2" href="/plans"><i class="icon fa fa-plus-square "></i> الكل</a></li>
         </ul>
       </li>
       @endcan
      @can('list subscriptions')
      <li class="treeview"><a class="app-menu__item {{{ (Request::is('/subscriptions*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> الاشتراكات </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/subscriptions"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>
      @endcan
      @can('list report')

      <li class="treeview"><a class="app-menu__item {{{ (Request::is('/reports*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> التقارير </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/reports"><i class="icon fa fa-plus-square "></i> الاشتراكات</a></li>
        {{-- <li><a class="treeview-item  mr-2" href="/reports/driver"><i class="icon fa fa-plus-square "></i> السائقين</a></li> --}}
        </ul>
      </li>
      @endcan
     @can('list users')
     <li class="treeview"><a class="app-menu__item {{{ (Request::is('/member*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user">
    </i><span class="app-menu__label">  التحكم بالاعضاء</span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
      <li><a class="treeview-item  mr-2" href="/member"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        
    </ul>
    </li>
    @endcan
    @can('list roles')
    <li class="treeview"><a class="app-menu__item {{{ (Request::is('/role*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user">
   </i><span class="app-menu__label">  التحكم بالصلاحيات</span><i class="treeview-indicator fa fa-angle-left"></i></a>
     <ul class="treeview-menu">
     <li><a class="treeview-item  mr-2" href="/roles"><i class="icon fa fa-plus-square "></i> الكل</a></li>
     </ul>
   </li>
    @endcan
    @can('list settings')
   <li class="treeview"><a class="app-menu__item {{{ (\Request::is('/settings/*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">  اعدادت </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/settings" rel="noopener"><i class="icon fa fa-edit"></i> الموقع</a></li>
        <li><a class="treeview-item  mr-2" href="/braintree" rel="noopener"><i class="icon fa fa-edit"></i> braintree الدفع</a></li>
        </ul>
   </li>
        @endcan
      </ul>
    </aside>