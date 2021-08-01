<header class="app-header"><a class="app-header__logo" href="/">{{$info->nameAr}}   </a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
         
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
        <i class="fa fa-user fa-lg"></i>
          
        <span class="app-sidebar__user-name">{{Auth::user()->name}}</span>
         
        </a>
          <ul class="dropdown-menu settings-menu dropdown-menu-left">
            @can('role-list')
            <li><a class="dropdown-item" href="/admin/setting/"><i class="fa fa-cog fa-lg"></i> اعدادات</a></li>
            @endcan
            <li><a class="dropdown-item" href="/admin/user/profile/"><i class="fa fa-user fa-lg"></i> البروفايل</a></li>
            <li>
            <a  class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" id="navbar-static-login" class="nav-link waves-effect waves-light" >

            <i class="fa fa-sign-out fa-lg"></i> خروج</a></li>
          </ul>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
        </li>
      </ul>
    </header>