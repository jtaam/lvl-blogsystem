@extends('layouts.frontend.app')

@section('title')
{{ucwords($post->title)}}
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/single-post/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/single-post/responsive.css')}}">
    <style>
        .favorite_posts {
            color: blue;
        }
        .slider {
            background-image: url({{ Storage::disk('public')->url('category/slider/'.$post->categories[0]->image) }}) !important;
        }
    </style>
@endpush

@section('content')
    <div class="slider">
        <div class="display-table  center-text">
            <h1 class="title display-table-cell">
                <b>{{ucwords($post->categories[0]->name)}}</b>
            </h1>
        </div>
    </div><!-- slider -->

    <section class="post-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12 no-right-padding">

                    <div class="main-post">

                        <div class="blog-post-inner">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}" alt="{{$post->user->name}}"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{$post->user->name}}</b></a>
                                    <h6 class="date">on {{$post->created_at->format('M d, Y')}}
                                        at {{$post->created_at->format('g:ia')}}</h6>
                                </div>

                            </div><!-- post-info -->

                            {{--<h3 class="title"><a href="#"><b>{{ucwords($post->title)}}</b></a></h3>--}}
                            <h3 class="title"><b>{{ucwords($post->title)}}</b></h3>

                            <p class="para">
                                {!! $post->post_promo !!}
                            </p>
                            <br>
                            <div class="post-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="{{$post->title}}" /></div>

                            <div class="para">
                                {!! $post->body !!}
                            </div>

                            <div class="tag-area">
                                <h4 class="title"><b>TAGS</b></h4>
                                <ul class="tags">
                                    @foreach($post->tags as $tag)
                                        <li><a href="{{route('tag.posts',$tag->slug)}}">{{ucwords($tag->name)}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">
                                <li>@guest
                                        <a href="javascript:void(0);"
                                           onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                                    class="ion-heart"></i>{{$post->favorite_to_users->count()}}
                                        </a>
                                    @else
                                        <a href="javascript:void(0);"
                                           onclick="document.getElementById('favorite-form-{{$post->id}}').submit();"
                                           class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count() ==0 ? 'favorite_posts':''}}">
                                            <i class="ion-heart"></i>{{$post->favorite_to_users->count()}}
                                        </a>
                                        <form id="favorite-form-{{$post->id}}" method="post"
                                              action="{{route('post.favorite',$post->id)}}"
                                              style="display: none;">@csrf</form>
                                    @endguest</li>
                                <li><a href="#comments"><i class="ion-chatbubble"></i>{{$post->comments()->count()}}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                            </ul>

                            <ul class="icons">
                                <li>SHARE : </li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                            </ul>
                        </div>

                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="sidebar-area about-area">
                            <h4 class="title"><b>ABOUT AUTHOR</b></h4>
                            <p>{{str_limit($post->user->about,200,'...')}}</p>
                        </div>

                        <div class="tag-area">

                            <h4 class="title"><b>CATEGORIES</b></h4>
                            <ul>
                                @foreach($post->categories as $category)
                                <li><a href="{{route('category.posts',$category->slug)}}">{{ucwords($category->name)}}</a></li>
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">
                @foreach($randomPosts as $randomPost)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$randomPost->image) }}" alt="{{$randomPost->title}}"></div>

                            <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$randomPost->user->image) }}" alt="{{$randomPost->user->name}}"></a>

                            <div class="blog-info">

                                <h4 class="title"><a href="{{route('post.details', $randomPost->slug)}}"><b>{{ucwords($randomPost->title)}}</b></a></h4>

                                <ul class="post-footer">
                                    <li>
                                        @guest
                                            <a href="javascript:void(0);"
                                               onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                                        class="ion-heart"></i>{{$randomPost->favorite_to_users->count()}}
                                            </a>
                                        @else
                                            <a href="javascript:void(0);"
                                               onclick="document.getElementById('favorite-form-{{$randomPost->id}}').submit();"
                                               class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$randomPost->id)->count() ==0 ? 'favorite_posts':''}}">
                                                <i class="ion-heart"></i>{{$randomPost->favorite_to_users->count()}}
                                            </a>
                                            <form id="favorite-form-{{$randomPost->id}}" method="post"
                                                  action="{{route('post.favorite',$randomPost->id)}}"
                                                  style="display: none;">@csrf</form>
                                        @endguest
                                    </li>
                                    <li><a href="{{route('post.details',$randomPost->slug)}}#comments"><i class="ion-chatbubble"></i>{{$randomPost->comments()->count()}}</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{$randomPost->view_count}}</a></li>
                                </ul>

                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-md-6 col-sm-12 -->
                @endforeach

            </div><!-- row -->

        </div><!-- container -->
    </section>

    <section class="comment-section" id="comments">
        <div class="container">
            <h4><b>POST COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                        @guest
                            <p>Please, <a href="{{route('login')}}" class="text-info">Login</a> to comment.</p>
                        @else
                            <form method="post" action="{{route('comment.store',$post->id)}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <textarea name="comment" rows="2" class="text-area-messge form-control"
                                                  placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                    </div><!-- col-sm-12 -->
                                    <div class="col-sm-12">
                                        <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                    </div><!-- col-sm-12 -->

                                </div><!-- row -->
                            </form>
                        @endguest
                    </div><!-- comment-form -->

                    <h4><b>COMMENTS({{$post->comments()->count()}})</b></h4>

                    @if($post->comments->count() > 0)
                        @foreach($post->comments as $comment)
                            <div class="commnets-area ">

                                <div class="comment">

                                    <div class="post-info">

                                        <div class="left-area">
                                            <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$comment->user->image) }}" alt="{{$comment->user->name}}"></a>
                                        </div>

                                        <div class="middle-area">
                                            <a class="name" href="#"><b>{{$comment->user->name}}</b></a>
                                            <h6 class="date">on {{$post->created_at->format('M d, Y')}} at {{$post->created_at->format('g:ia')}}</h6>
                                        </div>

                                    </div><!-- post-info -->

                                    <p>{!! $comment->comment !!}</p>

                                </div>

                            </div><!-- commnets-area -->
                        @endforeach
                    @else
                        <div class="commnets-area ">

                            <div class="comment">

                                <div class="post-info">
                                    <p>No comment on this post yet. Be the first!</p>
                                </div>
                            </div>
                        </div>
                    @endif

                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>
@endsection

@push('js')

@endpush