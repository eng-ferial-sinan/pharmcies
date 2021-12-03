 
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
       
      <ul class="app-menu">

        <li><a class="app-menu__item {{{ (\Request::is('/admin') ? 'active' : '') }}}" href="/admin"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">الرئيسة</span></a></li>
            
       </li>
      @can('list categories')
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/admin/category*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> الاصناف </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/admin/category"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>
     @endcan
      @can('list products')
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/admin/product*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
       </i><span class="app-menu__label">  المنتجات </span><i class="treeview-indicator fa fa-angle-left"></i></a>
       <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/admin/product/create"><i class="icon fa fa-plus-square "></i> إضافة منتج</a></li>
         <li><a class="treeview-item  mr-2" href="/admin/product"><i class="icon fa fa-plus-square "></i> الكل</a></li>
         </ul>
       </li>
       @endcan
       @can('list slides')
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/admin/slide*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> slide </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/admin/slide"><i class="icon fa fa-plus-square "></i> slide</a></li>
        </ul>
      </li>
     @endcan
     <li class="treeview"><a class="app-menu__item {{{ (Request::is('/admin/contact*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
    </i><span class="app-menu__label"> التواصل معنا </span><i class="treeview-indicator fa fa-angle-left"></i></a>
    <ul class="treeview-menu">
      <li><a class="treeview-item  mr-2" href="/admin/contact"><i class="icon fa fa-plus-square "></i>الكل</a></li>
      </ul>
    </li>
      @can('list orders')
      <li class="treeview"><a class="app-menu__item {{{ (Request::is('/admin/order*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> طلبيات </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/admin/order"><i class="icon fa fa-plus-square "></i> الكل</a></li>
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
            </ul>
   </li>
        @endcan
      </ul>
    </aside>