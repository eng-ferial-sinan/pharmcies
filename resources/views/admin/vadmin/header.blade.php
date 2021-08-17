<header class="app-header"><a class="app-header__logo" href="/">{{$info->nameAr}}   </a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
         
        <li class="dropdown">
          <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
            <i class="fa fa-bell-o fa-lg"></i>
       
       
            <span class="badge badge-pill badge-danger float-right">{{count(\Auth::user()->unreadnotifications)}}</span>
          </a>
          <ul class="app-notification dropdown-menu dropdown-menu-left">
               @if(count(\Auth::user()->notifications)>0)
              <div class="app-notification__content">
              @foreach (\Auth::user()->notifications as $item)
              <li><a class="app-notification__item {{($item->read_at ? '' : 'app-notification__unread')}}" href="/order/{{$item->data['id']}}"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
              <div >
                <p class="app-notification__message">
                   {{$item->data['pharmacy']}} : {{$item->data['user']}}
                   <br>
                   {{$item->data['driver']}} : {{$item->data['status']}}
                  <br > {{$item->created_at->diffForHumans()}}</p>
              </div></a></li>
                <?php $item->markAsRead() ?>

              @endforeach
              </div>
              @else 
              <li class="app-notification__title"> لديك 0 تنبيهات .</li>
              @endif 
              
              </div>
            </div>
            <li class="app-notification__footer"><a href="/order">عرض الكل.</a></li>
          </ul>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
        <i class="fa fa-user fa-lg"></i>
          
        <span class="app-sidebar__user-name">{{Auth::user()->name}}</span>
         
        </a>
          <ul class="dropdown-menu settings-menu dropdown-menu-left">
            {{-- @can('role-list') --}}
            <li><a class="dropdown-item" href="/setting/"><i class="fa fa-cog fa-lg"></i> اعدادات</a></li>
            {{-- @endcan --}}
            <li><a class="dropdown-item" href="/user/profile"><i class="fa fa-user fa-lg"></i> البروفايل</a></li>
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