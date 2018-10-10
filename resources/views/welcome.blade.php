@extends('layouts.frontend.app')

@section('title','Home')

@push('css')
    <link href="{{asset('assets/frontend/css/home/styles.css')}}" rel="stylesheet">

    <link href="{{asset('assets/frontend/css/home/responsive.css')}}" rel="stylesheet">

    <style>
        .favorite_posts {
            color: blue;
        }
    </style>
@endpush

@section('content')
    <div class="main-slider">
        <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
             data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
             data-swiper-breakpoints="true" data-swiper-loop="true">
            <div class="swiper-wrapper">

                @foreach($categories as $key=>$category)
                    <div class="swiper-slide">
                        <a class="slider-category" href="{{route('category.posts',$category->slug)}}">
                            <div class="blog-image"><img
                                        src="{{Storage::disk('public')->url('category/slider/'.$category->image)}}"
                                        alt="{{$category->name}}"></div>

                            <div class="category">
                                <div class="display-table center-text">
                                    <div class="display-table-cell">
                                        <h3><b>{{strtoupper($category->name)}}</b></h3>
                                    </div>
                                </div>
                            </div>

                        </a>
                    </div><!-- swiper-slide -->
                @endforeach

            </div><!-- swiper-wrapper -->

        </div><!-- swiper-container -->

    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img
                                        src="{{Storage::disk('public')->url('post/'.$posts[0]->image)}}"
                                        alt="{{$posts[0]->title}}"></div>

                            <a class="avatar" href="{{route('author.profile',$posts[0]->user->username)}}"><img
                                        src="{{ Storage::disk('public')->url('profile/'.$posts[0]->user->image) }}"
                                        alt="Profile Image"></a>
                            {{--<a class="avatar" href="{{route('author.profile',$posts[]->user->username)}}"><img src="{{asset('profile/'.$posts[0]->user->image)}}" alt="Profile Image"></a>--}}

                            <div class="blog-info">

                                <h4 class="title"><a href="{{route('post.details', $posts[0]->slug)}}"><b>{{ucwords($posts[0]->title)}}</b></a></h4>

                                <ul class="post-footer">
                                    <li>
                                        @guest
                                            <a href="javascript:void(0);"
                                               onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                                        class="ion-heart"></i>{{$posts[0]->favorite_to_users->count()}}
                                            </a>
                                        @else
                                            <a href="javascript:void(0);"
                                               onclick="document.getElementById('favorite-form-{{$posts[0]->id}}').submit();"
                                               class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$posts[0]->id)->count() ==0 ? 'favorite_posts':''}}">
                                                <i class="ion-heart"></i>{{$posts[0]->favorite_to_users->count()}}
                                            </a>
                                            <form id="favorite-form-{{$posts[0]->id}}" method="post"
                                                  action="{{route('post.favorite',$posts[0]->id)}}"
                                                  style="display: none;">@csrf</form>
                                        @endguest
                                    </li>
                                    <li><a href="{{route('post.details',$posts[0]->slug)}}#comments"><i class="ion-chatbubble"></i>{{$posts[0]->comments()->count()}}</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{$posts[0]->view_count}}</a></li>
                                </ul>

                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img
                                        src="{{Storage::disk('public')->url('post/'.$posts[1]->image)}}"
                                        alt="{{$posts[1]->title}}"></div>

                            <a class="avatar" href="{{route('author.profile',$posts[1]->user->username)}}"><img
                                        src="{{ Storage::disk('public')->url('profile/'.$posts[1]->user->image) }}"
                                        alt="Profile Image"></a>

                            <div class="blog-info">
                                <h4 class="title"><a href="{{route('post.details', $posts[1]->slug)}}"><b>{{ucwords($posts[1]->title)}}</b></a></h4>

                                <ul class="post-footer">
                                    <li>@guest
                                            <a href="javascript:void(0);"
                                               onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                                        class="ion-heart"></i>{{$posts[1]->favorite_to_users->count()}}
                                            </a>
                                        @else
                                            <a href="javascript:void(0);"
                                               onclick="document.getElementById('favorite-form-{{$posts[1]->id}}').submit();"
                                               class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$posts[1]->id)->count() ==0 ? 'favorite_posts':''}}">
                                                <i class="ion-heart"></i>{{$posts[1]->favorite_to_users->count()}}
                                            </a>
                                            <form id="favorite-form-{{$posts[1]->id}}" method="post"
                                                  action="{{route('post.favorite',$posts[1]->id)}}"
                                                  style="display: none;">@csrf</form>
                                        @endguest</li>
                                    <li><a href="{{route('post.details',$posts[1]->slug)}}#comments"><i class="ion-chatbubble"></i>{{$posts[1]->comments()->count()}}</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{$posts[1]->view_count}}</a></li>
                                </ul>
                            </div><!-- blog-info -->

                        </div><!-- single-post -->

                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img
                                        src="{{Storage::disk('public')->url('post/'.$posts[2]->image)}}"
                                        alt="{{$posts[2]->title}}"></div>

                            <a class="avatar" href="{{route('author.profile',$posts[2]->user->username)}}"><img
                                        src="{{ Storage::disk('public')->url('profile/'.$posts[2]->user->image) }}"
                                        alt="Profile Image"></a>

                            <h4 class="title"><a href="{{route('post.details', $posts[2]->slug)}}"><b>{{ucwords($posts[2]->title)}}</b></a></h4>

                            <ul class="post-footer">
                                <li>@guest
                                        <a href="javascript:void(0);"
                                           onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                                    class="ion-heart"></i>{{$posts[2]->favorite_to_users->count()}}</a>
                                    @else
                                        <a href="javascript:void(0);"
                                           onclick="document.getElementById('favorite-form-{{$posts[2]->id}}').submit();"
                                           class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$posts[2]->id)->count() ==0 ? 'favorite_posts':''}}">
                                            <i class="ion-heart"></i>{{$posts[2]->favorite_to_users->count()}}
                                        </a>
                                        <form id="favorite-form-{{$posts[2]->id}}" method="post"
                                              action="{{route('post.favorite',$posts[2]->id)}}"
                                              style="display: none;">@csrf</form>
                                    @endguest</li>
                                <li><a href="{{route('post.details',$posts[2]->slug)}}#comments"><i class="ion-chatbubble"></i>{{$posts[2]->comments()->count()}}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$posts[2]->view_count}}</a></li>
                            </ul>

                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-8 col-md-12">
                    <div class="card h-100">
                        <div class="single-post post-style-2">

                            <div class="blog-image"><img
                                        src="{{Storage::disk('public')->url('post/'.$posts[3]->image)}}"
                                        alt="{{$posts[3]->title}}"></div>

                            <div class="blog-info">

                                <h6 class="pre-title">
                                    @foreach($posts[3]->categories as $category)
                                        <a href="{{route('category.posts',$category->slug)}}"><b>{{strtoupper($category->name)}}</b></a>
                                    @endforeach
                                </h6>

                                <h4 class="title"><a href="{{route('post.details', $posts[3]->slug)}}"><b>{{ucwords($posts[3]->title)}}</b></a></h4>

                                <p>{!!str_limit($posts[3]->body,155,'')!!}</p>

                                <div class="avatar-area">
                                    <a class="avatar" href="{{route('author.profile',$posts[3]->user->username)}}"><img
                                                src="{{ Storage::disk('public')->url('profile/'.$posts[3]->user->image) }}"
                                                alt="Profile Image"></a>
                                    <div class="right-area">
                                        <a class="name" href="#"><b>{{$posts[3]->user->name}}</b></a>
                                        <h6 class="date" href="#">on {{$posts[3]->created_at->format('M d, Y')}}
                                            at {{$posts[3]->created_at->format('g:ia')}}</h6>
                                    </div>
                                </div>

                                <ul class="post-footer">
                                    <li>@guest
                                            <a href="javascript:void(0);"
                                               onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                                        class="ion-heart"></i>{{$posts[3]->favorite_to_users->count()}}
                                            </a>
                                        @else
                                            <a href="javascript:void(0);"
                                               onclick="document.getElementById('favorite-form-{{$posts[3]->id}}').submit();"
                                               class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$posts[3]->id)->count() ==0 ? 'favorite_posts':''}}">
                                                <i class="ion-heart"></i>{{$posts[3]->favorite_to_users->count()}}
                                            </a>
                                            <form id="favorite-form-{{$posts[3]->id}}" method="post"
                                                  action="{{route('post.favorite',$posts[3]->id)}}"
                                                  style="display: none;">@csrf</form>
                                        @endguest</li>
                                    <li><a href="{{route('post.details',$posts[3]->slug)}}#comments"><i class="ion-chatbubble"></i>{{$posts[3]->comments()->count()}}</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{$posts[3]->view_count}}</a></li>
                                </ul>

                            </div><!-- blog-right -->

                        </div><!-- single-post extra-blog -->

                    </div><!-- card -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img
                                        src="{{Storage::disk('public')->url('post/'.$posts[4]->image)}}"
                                        alt="{{$posts[4]->title}}"></div>

                            <a class="avatar" href="{{route('author.profile',$posts[4]->user->username)}}"><img
                                        src="{{ Storage::disk('public')->url('profile/'.$posts[4]->user->image) }}"
                                        alt="Profile Image"></a>

                            <h4 class="title"><a href="{{route('post.details', $posts[4]->slug)}}"><b>{{ucwords($posts[4]->title)}}</b></a></h4>

                            <ul class="post-footer">
                                <li>@guest
                                        <a href="javascript:void(0);"
                                           onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                                    class="ion-heart"></i>{{$posts[4]->favorite_to_users->count()}}</a>
                                    @else
                                        <a href="javascript:void(0);"
                                           onclick="document.getElementById('favorite-form-{{$posts[4]->id}}').submit();"
                                           class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$posts[4]->id)->count() ==0 ? 'favorite_posts':''}}">
                                            <i class="ion-heart"></i>{{$posts[4]->favorite_to_users->count()}}
                                        </a>
                                        <form id="favorite-form-{{$posts[4]->id}}" method="post"
                                              action="{{route('post.favorite',$posts[4]->id)}}"
                                              style="display: none;">@csrf</form>
                                    @endguest</li>
                                <li><a href="{{route('post.details',$posts[4]->slug)}}#comments"><i class="ion-chatbubble"></i>{{$posts[4]->comments()->count()}}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$posts[4]->view_count}}</a></li>
                            </ul>

                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">

                        <div class="single-post post-style-2 post-style-3">

                            <div class="blog-info">

                                <h6 class="pre-title">
                                    @foreach($posts[5]->categories as $category)
                                        <a href="{{route('category.posts',$category->slug)}}"><b>{{strtoupper($category->name)}}</b></a>
                                    @endforeach
                                </h6>
                                <h4 class="title"><a href="{{route('post.details', $posts[5]->slug)}}"><b>{{ucwords($posts[5]->title)}}</b></a></h4>

                                <p>{!! str_limit($posts[5]->body,155,'') !!}</p>

                                <div class="avatar-area">
                                    <a class="avatar" href="{{route('author.profile',$posts[5]->user->username)}}"><img
                                                src="{{ Storage::disk('public')->url('profile/'.$posts[5]->user->image) }}"
                                                alt="Profile Image"></a>
                                    <div class="right-area">
                                        <a class="name" href="#"><b>{{$posts[5]->user->name}}</b></a>
                                        <h6 class="date" href="#">on {{$posts[5]->created_at->format('M d, Y')}}
                                            at {{$posts[5]->created_at->format('g:ia')}}</h6>
                                    </div>
                                </div>

                                <ul class="post-footer">
                                    <li>@guest
                                            <a href="javascript:void(0);"
                                               onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                                        class="ion-heart"></i>{{$posts[5]->favorite_to_users->count()}}
                                            </a>
                                        @else
                                            <a href="javascript:void(0);"
                                               onclick="document.getElementById('favorite-form-{{$posts[5]->id}}').submit();"
                                               class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$posts[5]->id)->count() ==0 ? 'favorite_posts':''}}">
                                                <i class="ion-heart"></i>{{$posts[5]->favorite_to_users->count()}}
                                            </a>
                                            <form id="favorite-form-{{$posts[5]->id}}" method="post"
                                                  action="{{route('post.favorite',$posts[5]->id)}}"
                                                  style="display: none;">@csrf</form>
                                        @endguest</li>
                                    <li><a href="{{route('post.details',$posts[5]->slug)}}#comments"><i class="ion-chatbubble"></i>{{$posts[5]->comments()->count()}}</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{$posts[5]->view_count}}</a></li>
                                </ul>

                            </div><!-- blog-right -->

                        </div><!-- single-post extra-blog -->

                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img
                                        src="{{Storage::disk('public')->url('post/'.$posts[6]->image)}}"
                                        alt="{{$posts[6]->title}}"></div>

                            <a class="avatar" href="{{route('author.profile',$posts[6]->user->username)}}"><img
                                        src="{{ Storage::disk('public')->url('profile/'.$posts[6]->user->image) }}"
                                        alt="Profile Image"></a>

                            <div class="blog-info">
                                <h4 class="title"><a href="{{route('post.details', $posts[6]->slug)}}"><b>{{ucwords($posts[6]->title)}}</b></a></h4>

                                <ul class="post-footer">
                                    <li>@guest
                                            <a href="javascript:void(0);"
                                               onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                                        class="ion-heart"></i>{{$posts[6]->favorite_to_users->count()}}
                                            </a>
                                        @else
                                            <a href="javascript:void(0);"
                                               onclick="document.getElementById('favorite-form-{{$posts[6]->id}}').submit();"
                                               class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$posts[6]->id)->count() ==0 ? 'favorite_posts':''}}">
                                                <i class="ion-heart"></i>{{$posts[6]->favorite_to_users->count()}}
                                            </a>
                                            <form id="favorite-form-{{$posts[6]->id}}" method="post"
                                                  action="{{route('post.favorite',$posts[6]->id)}}"
                                                  style="display: none;">@csrf</form>
                                        @endguest</li>
                                    <li><a href="{{route('post.details',$posts[6]->slug)}}#comments"><i class="ion-chatbubble"></i>{{$posts[6]->comments()->count()}}</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{$posts[6]->view_count}}</a></li>
                                </ul>
                            </div><!-- blog-info -->

                        </div><!-- single-post -->

                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">

                        <div class="single-post post-style-4">

                            <div class="display-table">
                                <h4 class="title display-table-cell"><a href="{{route('post.details', $posts[7]->slug)}}"><b>{{ucwords($posts[7]->title)}}</b></a></h4>
                            </div>

                            <ul class="post-footer">
                                <li>@guest
                                        <a href="javascript:void(0);"
                                           onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                                    class="ion-heart"></i>{{$posts[7]->favorite_to_users->count()}}</a>
                                    @else
                                        <a href="javascript:void(0);"
                                           onclick="document.getElementById('favorite-form-{{$posts[7]->id}}').submit();"
                                           class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$posts[7]->id)->count() ==0 ? 'favorite_posts':''}}">
                                            <i class="ion-heart"></i>{{$posts[7]->favorite_to_users->count()}}
                                        </a>
                                        <form id="favorite-form-{{$posts[7]->id}}" method="post"
                                              action="{{route('post.favorite',$posts[7]->id)}}"
                                              style="display: none;">@csrf</form>
                                    @endguest</li>
                                <li><a href="{{route('post.details',$posts[7]->slug)}}#comments"><i class="ion-chatbubble"></i>{{$posts[7]->comments()->count()}}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$posts[7]->view_count}}</a></li>
                            </ul>

                        </div><!-- single-post -->

                        <div class="single-post">

                            <div class="display-table">
                                <h4 class="title display-table-cell"><a href="{{route('post.details', $posts[8]->slug)}}"><b>{{ucwords($posts[8]->title)}}</b></a></h4>
                            </div>

                            <ul class="post-footer">
                                <li>@guest
                                        <a href="javascript:void(0);"
                                           onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                                    class="ion-heart"></i>{{$posts[8]->favorite_to_users->count()}}</a>
                                    @else
                                        <a href="javascript:void(0);"
                                           onclick="document.getElementById('favorite-form-{{$posts[8]->id}}').submit();"
                                           class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$posts[8]->id)->count() ==0 ? 'favorite_posts':''}}">
                                            <i class="ion-heart"></i>{{$posts[8]->favorite_to_users->count()}}
                                        </a>
                                        <form id="favorite-form-{{$posts[8]->id}}" method="post"
                                              action="{{route('post.favorite',$posts[8]->id)}}"
                                              style="display: none;">@csrf</form>
                                    @endguest</li>
                                <li><a href="{{route('post.details',$posts[8]->slug)}}#comments"><i class="ion-chatbubble"></i>{{$posts[8]->comments()->count()}}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$posts[8]->view_count}}</a></li>
                            </ul>

                        </div><!-- single-post -->

                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">

                        <div class="single-post post-style-4">

                            <div class="display-table">
                                <h4 class="title display-table-cell"><a href="{{route('post.details', $posts[9]->slug)}}"><b>{{ucwords($posts[9]->title)}}</b></a></h4>
                            </div>

                            <ul class="post-footer">
                                <li>@guest
                                        <a href="javascript:void(0);"
                                           onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                                    class="ion-heart"></i>{{$posts[9]->favorite_to_users->count()}}</a>
                                    @else
                                        <a href="javascript:void(0);"
                                           onclick="document.getElementById('favorite-form-{{$posts[9]->id}}').submit();"
                                           class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$posts[9]->id)->count() ==0 ? 'favorite_posts':''}}">
                                            <i class="ion-heart"></i>{{$posts[9]->favorite_to_users->count()}}
                                        </a>
                                        <form id="favorite-form-{{$posts[9]->id}}" method="post"
                                              action="{{route('post.favorite',$posts[9]->id)}}"
                                              style="display: none;">@csrf</form>
                                    @endguest</li>
                                <li><a href="{{route('post.details',$posts[9]->slug)}}#comments"><i class="ion-chatbubble"></i>{{$posts[9]->comments()->count()}}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$posts[9]->view_count}}</a></li>
                            </ul>

                        </div><!-- single-post -->

                        <div class="single-post">

                            <div class="display-table">
                                <h4 class="title display-table-cell"><a href="{{route('post.details', $posts[10]->slug)}}"><b>{{ucwords($posts[10]->title)}}</b></a></h4>
                            </div>

                            <ul class="post-footer">
                                <li>@guest
                                        <a href="javascript:void(0);"
                                           onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                                    class="ion-heart"></i>{{$posts[10]->favorite_to_users->count()}}</a>
                                    @else
                                        <a href="javascript:void(0);"
                                           onclick="document.getElementById('favorite-form-{{$posts[10]->id}}').submit();"
                                           class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$posts[10]->id)->count() ==0 ? 'favorite_posts':''}}">
                                            <i class="ion-heart"></i>{{$posts[10]->favorite_to_users->count()}}
                                        </a>
                                        <form id="favorite-form-{{$posts[10]->id}}" method="post"
                                              action="{{route('post.favorite',$posts[10]->id)}}"
                                              style="display: none;">@csrf</form>
                                    @endguest</li>
                                <li><a href="{{route('post.details',$posts[10]->slug)}}#comments"><i class="ion-chatbubble"></i>{{$posts[10]->comments()->count()}}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$posts[10]->view_count}}</a></li>
                            </ul>

                        </div><!-- single-post -->

                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-8 col-md-12">
                    <div class="card h-100">
                        <div class="single-post post-style-2">

                            <div class="blog-image"><img
                                        src="{{Storage::disk('public')->url('post/'.$posts[11]->image)}}"
                                        alt="{{$posts[11]->title}}"></div>

                            <div class="blog-info">

                                <h6 class="pre-title">
                                    @foreach($posts[11]->categories as $category)
                                        <a href="{{route('category.posts', $category->slug)}}"><b>{{strtoupper($category->name)}}</b></a>
                                    @endforeach
                                </h6>


                                <h4 class="title"><a href="{{route('post.details', $posts[11]->slug)}}"><b>{{ucwords($posts[11]->title)}}</b></a></h4>

                                <p>{!! str_limit($posts[11]->body,155,'') !!}</p>

                                <div class="avatar-area">
                                    <a class="avatar" href="{{route('author.profile',$posts[11]->user->username)}}"><img
                                                src="{{ Storage::disk('public')->url('profile/'.$posts[11]->user->image) }}"
                                                alt="Profile Image"></a>
                                    <div class="right-area">
                                        <a class="name" href="#"><b>{{$posts[11]->user->name}}</b></a>
                                        <h6 class="date" href="#">on {{$posts[11]->created_at->format('M d, Y')}}
                                            at {{$posts[11]->created_at->format('g:ia')}}</h6>
                                    </div>
                                </div>

                                <ul class="post-footer">
                                    <li>@guest
                                            <a href="javascript:void(0);"
                                               onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                                        class="ion-heart"></i>{{$posts[11]->favorite_to_users->count()}}
                                            </a>
                                        @else
                                            <a href="javascript:void(0);"
                                               onclick="document.getElementById('favorite-form-{{$posts[11]->id}}').submit();"
                                               class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$posts[11]->id)->count() ==0 ? 'favorite_posts':''}}">
                                                <i class="ion-heart"></i>{{$posts[11]->favorite_to_users->count()}}
                                            </a>
                                            <form id="favorite-form-{{$posts[11]->id}}" method="post"
                                                  action="{{route('post.favorite',$posts[11]->id)}}"
                                                  style="display: none;">@csrf</form>
                                        @endguest</li>
                                    <li><a href="{{route('post.details',$posts[11]->slug)}}#comments"><i class="ion-chatbubble"></i>{{$posts[11]->comments()->count()}}</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{$posts[11]->view_count}}</a></li>
                                </ul>

                            </div><!-- blog-right -->

                        </div><!-- single-post extra-blog -->

                    </div><!-- card -->
                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

            <a class="load-more-btn" href="{{route('posts.index')}}"><b>LOAD MORE</b></a>

        </div><!-- container -->
    </section><!-- section -->
@endsection

@push('js')
    <script src="{{asset('assets/frontend/js/swiper.js')}}"></script>
@endpush