 
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
       
      <ul class="app-menu">

        <li><a class="app-menu__item {{{ (\Request::is('/') ? 'active' : '') }}}" href="/"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">الرئيسة</span></a></li>
            
       </li>
      @can('list categories')
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/category*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> الاصناف </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/category"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>
     @endcan
      @can('list products')
       <li class="treeview"><a class="app-menu__item {{{ (Request::is('/product*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
       </i><span class="app-menu__label">  المنتجات </span><i class="treeview-indicator fa fa-angle-left"></i></a>
       <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/product/create"><i class="icon fa fa-plus-square "></i> إضافة دواء</a></li>
         <li><a class="treeview-item  mr-2" href="/product"><i class="icon fa fa-plus-square "></i> الكل</a></li>
         </ul>
       </li>
       @endcan

      @can('list orders')
      <li class="treeview"><a class="app-menu__item {{{ (Request::is('/order*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> طلبيات </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/order"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        </ul>
      </li>
      @endcan
      @can('list report')

      <li class="treeview"><a class="app-menu__item {{{ (Request::is('/reports*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar-check-o">
      </i><span class="app-menu__label"> التقارير </span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item  mr-2" href="/reports"><i class="icon fa fa-plus-square "></i> الطلبات</a></li>
        {{-- <li><a class="treeview-item  mr-2" href="/reports/driver"><i class="icon fa fa-plus-square "></i> السائقين</a></li> --}}
        </ul>
      </li>
      @endcan
     @can('list users')
     <li class="treeview"><a class="app-menu__item {{{ (Request::is('member*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user">
    </i><span class="app-menu__label">  التحكم بالاعضاء</span><i class="treeview-indicator fa fa-angle-left"></i></a>
      <ul class="treeview-menu">
      <li><a class="treeview-item  mr-2" href="/member"><i class="icon fa fa-plus-square "></i> الكل</a></li>
        
    </ul>
    </li>
    @endcan
    @can('list roles')
    <li class="treeview"><a class="app-menu__item {{{ (Request::is('admin/role*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user">
   </i><span class="app-menu__label">  التحكم بالصلاحيات</span><i class="treeview-indicator fa fa-angle-left"></i></a>
     <ul class="treeview-menu">
     <li><a class="treeview-item  mr-2" href="/roles"><i class="icon fa fa-plus-square "></i> الكل</a></li>
     </ul>
   </li>
    @endcan
    @can('list settings')
   <li class="treeview"><a class="app-menu__item {{{ (\Request::is('settings/*') ? 'active' : '') }}}" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">  اعدادت </span><i class="treeview-indicator fa fa-angle-left"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item  mr-2" href="/settings" rel="noopener"><i class="icon fa fa-edit"></i> الموقع</a></li>
            </ul>
   </li>
        @endcan
      </ul>
    </aside>