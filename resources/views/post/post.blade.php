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
            background-image: url({{$post->categories[0]->image}}) !important;
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
                                    <a class="avatar" href="{{route('author.profile',$post->user->username)}}"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}" alt="{{$post->user->name}}"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="{{route('author.profile',$post->user->username)}}"><b>{{$post->user->name}}</b></a>
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
                            <div class="post-image"><img src="{{ $post->image }}" alt="{{$post->title}}" /></div>

                            <div class="para">
                                {!! $post->body !!}
                            </div>

                            <div class="tag-area">
                                @include('post-includes.tag')
                            </div>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            @include('post-includes.icon')

                            @include('post-includes.share')
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
        @include('post-includes.random')
    </section>

    <section class="comment-section" id="comments">
        @include('post-includes.comment')
    </section>
@endsection

@push('js')

@endpush