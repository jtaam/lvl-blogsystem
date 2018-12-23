<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{Storage::disk('public')->url('profile/'.Auth::user()->image)}}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
            <div class="email">{{Auth::user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">

                    <li><a href="{{Auth::user()->role->id==1 ? route('admin.settings'):route('author.settings')}}"><i class="material-icons">settings</i>Settings</a></li>

                    <li role="separator" class="divider"></li>
                    {{--LOGOUT--}}
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form-1').submit();">
                            <i class="material-icons">input</i>{{ __('Sign Out') }}
                        </a>

                        <form id="logout-form-1" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
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
                {{--TAG--}}
                <li class="{{Request::is('admin/tag*')?'active':''}}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">label</i>
                        <span>Tag</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('admin.tag.index')}}"><i class="material-icons">bookmarks</i><span>All Tags</span></a>
                        </li>
                        <li>
                            <a href="{{route('admin.tag.create')}}"><i class="material-icons">playlist_add</i><span>Add Tag</span></a>
                        </li>
                    </ul>
                </li>
                {{--CATEGORY--}}
                <li class="{{Request::is('admin/category*')?'active':''}}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">category</i>
                        <span>Category</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('admin.category.index')}}"><i class="material-icons">view_list</i><span>All Categories</span></a>
                        </li>
                        <li>
                            <a href="{{route('admin.category.create')}}"><i class="material-icons">add_photo_alternate</i><span>Add Category</span></a>
                        </li>
                    </ul>
                </li>
                {{--POST--}}
                <li class="{{Request::is('admin/*post*')?'active':''}}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">library_books</i>
                        <span>Posts</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('admin.post.index')}}"><i class="material-icons">featured_play_list</i><span>All Posts</span></a>
                        </li>
                        <li>
                            <a href="{{route('admin.post.create')}}"><i class="material-icons">note_add</i><span>Add Post</span></a>
                        </li>
                        <li>
                            <a href="{{route('admin.post.pending')}}"><i class="material-icons">notification_important</i><span>Pending Posts</span></a>
                        </li>
                    </ul>
                </li>
                {{--FAVORITE POSTS--}}
                <li class="{{Request::is('admin/favorite*')?'active':''}}">
                    <a href="{{route('admin.favorite.index')}}" class="">
                        <i class="material-icons">favorite</i>
                        <span>Favorite Posts</span>
                    </a>
                </li>
                {{--COMMENTS--}}
                <li class="{{Request::is('admin/comment*')?'active':''}}">
                    <a href="{{route('admin.comment.index')}}" class="">
                        <i class="material-icons">comment</i>
                        <span>Comments</span>
                    </a>
                </li>
                {{--SUBSCRIBER--}}
                <li class="{{Request::is('admin/subscriber')?'active':''}}">
                    <a href="{{route('admin.subscriber.index')}}" class="">
                        <i class="material-icons">email</i>
                        <span>Subscribers</span>
                    </a>
                </li>
                {{--AUTHOR--}}
                <li class="{{Request::is('admin/author*')?'active':''}}">
                    <a href="{{route('admin.author.index')}}">
                        <i class="material-icons">people</i>
                        <span>Authors</span>
                    </a>
                </li>
                {{--CLOUDINARY--}}
                <li class="{{Request::is('admin/cloudinary*')?'active':''}}">
                    <a href="{{route('admin.cloudinary.index')}}">
                        <i class="material-icons">cloud</i>
                        <span>Cloudinary</span>
                    </a>
                </li>
                <li class="header">System</li>
                {{--SETTINGS--}}
                <li class="{{Request::is('admin/settings')?'active':''}}">
                    <a href="{{route('admin.settings')}}" class="">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                </li>
                {{--LOGOUT--}}
                <li class="">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form-2').submit();">
                        <i class="material-icons">input</i><span>{{ __('Logout') }}</span>
                    </a>

                    <form id="logout-form-2" action="{{ route('logout') }}" method="POST" style="display: none;">
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
                {{--POST--}}
                <li class="{{Request::is('author/post*')?'active':''}}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">library_books</i>
                        <span>Posts</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{route('author.post.index')}}"><i class="material-icons">featured_play_list</i><span>All Posts</span></a>
                        </li>
                        <li>
                            <a href="{{route('author.post.create')}}"><i class="material-icons">note_add</i><span>Add Post</span></a>
                        </li>
                    </ul>
                </li>
                {{--FAVORITE POSTS--}}
                <li class="{{Request::is('author/favorite*')?'active':''}}">
                    <a href="{{route('author.favorite.index')}}" class="">
                        <i class="material-icons">favorite</i>
                        <span>Favorite Posts</span>
                    </a>
                </li>
                {{--COMMENTS--}}
                <li class="{{Request::is('author/comment*')?'active':''}}">
                    <a href="{{route('author.comment.index')}}" class="">
                        <i class="material-icons">comment</i>
                        <span>Comments</span>
                    </a>
                </li>
                <li class="header">System</li>
                {{--SETTINGS--}}
                <li class="{{Request::is('author/settings')?'active':''}}">
                    <a href="{{route('author.settings')}}" class="">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                </li>
                {{--LOGOUT--}}
                <li class="">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form-2').submit();">
                        <i class="material-icons">input</i><span>{{ __('Logout') }}</span>
                    </a>

                    <form id="logout-form-2" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif


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