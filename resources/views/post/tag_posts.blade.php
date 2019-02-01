@extends('layouts.frontend.app')

@section('title','Posts by Tag')

@push('css')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/post/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/post/responsive.css')}}">
    <style>
        .favorite_posts {
            color: blue;
        }
        .slider {
            {{--background-image: url({{ Storage::disk('public')->url('category/slider/'.$tag->image) }}) !important;--}}
        }
        .posts_pagination {

        }
    </style>
@endpush

@section('content')
    <div class="slider">
        <div class="display-table center-text">
            <h1 class="title display-table-cell">
                <b>{{strtoupper($tag->name)}}</b>
            </h1>
        </div>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">
                @if($posts->count() > 0)
                    @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100">
                                <div class="single-post post-style-1">

                                    <div class="blog-image"><img
                                                @if (config('app.env') =='production')
                                                    src="{{$post->image}}"
                                                @else
                                                    src="{{ Storage::disk('public')->url('post/'.$post->image) }}"
                                                @endif
                                                    alt="{{$post->title}}"></div>

                                    <a class="avatar" href="{{route('author.profile',$post->user->username)}}"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}" alt="{{$post->user->name}}"></a>

                                    <div class="blog-info">

                                        <h4 class="title"><a href="{{route('post.details',$post->slug)}}"><b>{{$post->title}}</b></a></h4>

                                        <ul class="post-footer">
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
                                            <li><a href="{{route('post.details',$post->slug)}}#comments"><i class="ion-chatbubble"></i>{{$post->comments()->count()}}</a></li>
                                            <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                                        </ul>

                                    </div><!-- blog-info -->
                                </div><!-- single-post -->
                            </div><!-- card -->
                        </div><!-- col-lg-4 col-md-6 -->
                    @endforeach
                @else
                    <div class="col-lg-12 col-md-12">
                        <div class="card h-100">
                            <div class="single-post post-style-1">
                                <div class="blog-info">
                                    <h4 class="title">No post found in this {{$tag->name}} category</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div><!-- row -->
            <div class="posts_pagination">
                {{--{{$tag->posts->links()}}--}}
            </div>
            {{--<a class="load-more-btn" href="#"><b>LOAD MORE</b></a>--}}

        </div><!-- container -->
    </section><!-- section -->
    
@endsection

@push('js')

@endpush