<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{asset('assets/backend/images/user.png')}}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
            <div class="email">{{Auth::user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    {{--<li role="separator" class="divider"></li>--}}
                    {{--<li>--}}
                        {{--<a class="dropdown-item" href="{{ route('logout') }}"--}}
                           {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                            {{--<i class="material-icons">input</i>{{ __('Sign Out') }}--}}
                        {{--</a>--}}

                        {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                            {{--@csrf--}}
                        {{--</form>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            {{--Admin dashboard--}}
            @if(Request::is('admin*'))
                <li class="{{Request::is('admin/dashboard')?'active':''}}">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{Request::is('admin/tag*')?'active':''}}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">label</i>
                        <span>Tag</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('admin.tag.index')}}">All Tags</a>
                        </li>
                        <li>
                            <a href="{{route('admin.tag.create')}}">Add Tag</a>
                        </li>
                    </ul>
                </li>

                <li class="{{Request::is('admin/category*')?'active':''}}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">category</i>
                        <span>Category</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('admin.category.index')}}">All Categories</a>
                        </li>
                        <li>
                            <a href="{{route('admin.category.create')}}">Add Category</a>
                        </li>
                    </ul>
                </li>

                <li class="header">System</li>

                <li class="">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i><span>{{ __('Logout') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif
            {{--Author dashboard--}}
            @if(Request::is('author*'))
                <li class="{{Request::is('author/dashboard')?'active':''}}">
                    <a href="{{route('author.dashboard')}}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="header">System</li>
                <li class="">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i><span>{{ __('Logout') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif


            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">swap_calls</i>
                    <span>User Interface (UI)</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/ui/alerts.html">Alerts</a>
                    </li>
                    <li>
                        <a href="pages/ui/animations.html">Animations</a>
                    </li>
                    <li>
                        <a href="pages/ui/badges.html">Badges</a>
                    </li>

                    <li>
                        <a href="pages/ui/breadcrumbs.html">Breadcrumbs</a>
                    </li>
                    <li>
                        <a href="pages/ui/buttons.html">Buttons</a>
                    </li>
                    <li>
                        <a href="pages/ui/collapse.html">Collapse</a>
                    </li>
                    <li>
                        <a href="pages/ui/colors.html">Colors</a>
                    </li>
                    <li>
                        <a href="pages/ui/dialogs.html">Dialogs</a>
                    </li>
                    <li>
                        <a href="pages/ui/icons.html">Icons</a>
                    </li>
                    <li>
                        <a href="pages/ui/labels.html">Labels</a>
                    </li>
                    <li>
                        <a href="pages/ui/list-group.html">List Group</a>
                    </li>
                    <li>
                        <a href="pages/ui/media-object.html">Media Object</a>
                    </li>
                    <li>
                        <a href="pages/ui/modals.html">Modals</a>
                    </li>
                    <li>
                        <a href="pages/ui/notifications.html">Notifications</a>
                    </li>
                    <li>
                        <a href="pages/ui/pagination.html">Pagination</a>
                    </li>
                    <li>
                        <a href="pages/ui/preloaders.html">Preloaders</a>
                    </li>
                    <li>
                        <a href="pages/ui/progressbars.html">Progress Bars</a>
                    </li>
                    <li>
                        <a href="pages/ui/range-sliders.html">Range Sliders</a>
                    </li>
                    <li>
                        <a href="pages/ui/sortable-nestable.html">Sortable & Nestable</a>
                    </li>
                    <li>
                        <a href="pages/ui/tabs.html">Tabs</a>
                    </li>
                    <li>
                        <a href="pages/ui/thumbnails.html">Thumbnails</a>
                    </li>
                    <li>
                        <a href="pages/ui/tooltips-popovers.html">Tooltips & Popovers</a>
                    </li>
                    <li>
                        <a href="pages/ui/waves.html">Waves</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>