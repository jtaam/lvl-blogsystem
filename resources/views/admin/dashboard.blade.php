@extends('layouts.backend.app')

@section('title','Admin')

@push('css')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL POSTS</div>
                        @if (isset($posts))
                            <div class="number count-to" data-from="0" data-to="{{$posts->count()}}" data-speed="700"
                                 data-fresh-interval="20"></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">favorite</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL FAVORITE</div>
                        <div class="number count-to" data-from="0" data-to="{{Auth::user()->favorite_posts()->count()}}"
                             data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">library_books</i>
                    </div>
                    <div class="content">
                        <div class="text">PENDING POSTS</div>
                        @if (isset($total_pending_posts))
                            <div class="number count-to" data-from="0" data-to="{{$total_pending_posts}}"
                                 data-speed="2000" data-fresh-interval="20"></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">pageview</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL VIEWS</div>
                        @if (isset($all_views))
                            <div class="number count-to" data-from="0" data-to="{{$all_views}}" data-speed="1000"
                                 data-fresh-interval="20"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <div class="info-box bg-blue-grey hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">apps</i>
                    </div>
                    <div class="content">
                        <div class="text">CATEGORIES</div>
                        @if (isset($category_count))
                            <div class="number count-to" data-from="0" data-to="{{$category_count}}" data-speed="700"
                                 data-fresh-interval="20"></div>
                        @endif
                    </div>
                </div>

                <div class="info-box bg-amber hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">labels</i>
                    </div>
                    <div class="content">
                        <div class="text">TAGS</div>
                        @if (isset($tag_count))
                            <div class="number count-to" data-from="0" data-to="{{$tag_count}}" data-speed="700"
                                 data-fresh-interval="20"></div>
                        @endif
                    </div>
                </div>

                <div class="info-box bg-brown hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">supervised_user_circle</i>
                    </div>
                    <div class="content">
                        <div class="text">AUTHORS</div>
                        @if (isset($authors_count))
                            <div class="number count-to" data-from="0" data-to="{{$authors_count}}" data-speed="700"
                                 data-fresh-interval="20"></div>
                        @endif
                    </div>
                </div>

                <div class="info-box bg-purple hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">fiber_new</i>
                    </div>
                    <div class="content">
                        <div class="text">TODAY AUTHORS</div>
                        @if (isset($new_authors_today))
                            <div class="number count-to" data-from="0" data-to="{{$new_authors_today}}" data-speed="700"
                                 data-fresh-interval="20"></div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <div class="card">
                    <div class="header">
                        <h2>MOST POPULAR POSTS</h2>
                    </div>
                    <div class="body">
                        <table class="table table-responsive dashboard-task-infos">
                            <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Views</th>
                                <th>Favorite</th>
                                <th>Comments</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($popular_posts))
                                @foreach($popular_posts as $key=>$post)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{str_limit($post->title,20)}}</td>
                                        <td>{{$post->user->name}}</td>
                                        <td>{{$post->view_count}}</td>
                                        <td>{{$post->favorite_posts_count}}</td>
                                        <td>{{$post->comments_count}}</td>
                                        <td>
                                            @if($post->status == true)
                                                <span class="label bg-green">Published</span>
                                            @else
                                                <span class="label bg-red">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('post.details',$post->slug)}}"
                                               class="btn btn-sm btn-primary" target="_blank">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->

        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>TOP 10 ACTIVE AUTHORS</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th>Comments</th>
                                    <th>Favorite</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (isset($active_authors))
                                    @foreach($active_authors as $key=>$author)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$author->name}}</td>
                                            <td>{{$author->posts_count}}</td>
                                            <td>{{$author->comments_count}}</td>
                                            <td>{{$author->favorite_posts_count}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('assets/backend/js/pages/index.js')}}"></script>
@endpush