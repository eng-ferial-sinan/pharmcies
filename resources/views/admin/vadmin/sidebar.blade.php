 
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
       
      <ul class="app-menu">

        <li><a class="app-menu__item {{{ (\Request::is('/admin') ? 'active' : '') }}}" href="/admin"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">الرئيسة</span></a></li>
            
       </li>
      @can('list salons')
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/admin/salon*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> الصوالين </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/admin/salon"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>
     @endcan
      @can('list services')
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/admin/service*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
       </i><span class="app-menu__label">  الخدمات </span><i class="treeview-indicator fa fa-angle-left"></i></a>
       <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/admin/service/create"><i class="icon fa fa-plus-square "></i> إضافة خدمة</a></li>
         <li><a class="treeview-item  mr-2" href="/admin/service"><i class="icon fa fa-plus-square "></i> الكل</a></li>
         </ul>
       </li>
       @endcan
       @can('list promotions')
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/admin/promotion*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> العروض </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/admin/promotion"><i class="icon fa fa-plus-square "></i> promotion</a></li>
        </ul>
      </li>
     @endcan

      @can('list reservations')
      <li class="treeview"><a class="app-menu__item {{{ (Request::is('/admin/reservation*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> الحجوزات </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/admin/reservation"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>
      @endcan
      @can('list report')

      <li class="treeview"><a class="app-menu__item {{{ (Request::is('/admin/reports*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> التقارير </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/admin/reports"><i class="icon fa fa-plus-square "></i> الطلبات</a></li>
        {{-- <li><a class="treeview-item  mr-2" href="/reports/driver"><i class="icon fa fa-plus-square "></i> السائقين</a></li> --}}
        </ul>
      </li>
      @endcan
     @can('list users')
     <li class="treeview"><a class="app-menu__item {{{ (Request::is('/admin/member*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user">
    </i><span class="app-menu__label">  التحكم بالاعضاء</span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
      <li><a class="treeview-item  mr-2" href="/admin/member"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        
    </ul>
    </li>
    @endcan
    @can('list roles')
    <li class="treeview"><a class="app-menu__item {{{ (Request::is('/admin/role*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user">
   </i><span class="app-menu__label">  التحكم بالصلاحيات</span><i class="treeview-indicator fa fa-angle-left"></i></a>
     <ul class="treeview-menu">
     <li><a class="treeview-item  mr-2" href="/admin/roles"><i class="icon fa fa-plus-square "></i> الكل</a></li>
     </ul>
   </li>
    @endcan
    @can('list settings')
   <li class="treeview"><a class="app-menu__item {{{ (\Request::is('/admin/settings/*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">  اعدادت </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/admin/settings" rel="noopener"><i class="icon fa fa-edit"></i> الموقع</a></li>
        <li><a class="treeview-item  mr-2" href="/admin/braintree" rel="noopener"><i class="icon fa fa-edit"></i> braintree الدفع</a></li>
        </ul>
   </li>
        @endcan
      </ul>
    </aside>