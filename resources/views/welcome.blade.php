@extends('layouts.frontend.app')

@section('title','Home')

@push('css')
    <link href="{{asset('assets/frontend/css/home/styles.css')}}" rel="stylesheet">

    <link href="{{asset('assets/frontend/css/home/responsive.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="main-slider">
        <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
             data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
             data-swiper-breakpoints="true" data-swiper-loop="true" >
            <div class="swiper-wrapper">

                @foreach($categories as $key=>$category)
                <div class="swiper-slide">
                    <a class="slider-category" href="#">
                        <div class="blog-image"><img src="{{Storage::disk('public')->url('category/slider/'.$category->image)}}" alt="{{$category->name}}"></div>

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

                            <div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$posts[0]->image)}}" alt="{{$posts[0]->title}}"></div>

                            <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$posts[0]->user->image) }}" alt="Profile Image"></a>
                            {{--<a class="avatar" href="#"><img src="{{asset('profile/'.$posts[0]->user->image)}}" alt="Profile Image"></a>--}}

                            <div class="blog-info">

                                <h4 class="title"><a href="#"><b>{{ucwords($posts[0]->title)}}</b></a></h4>

                                <ul class="post-footer">
                                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>138</a></li>
                                </ul>

                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$posts[1]->image)}}" alt="{{$posts[1]->title}}"></div>

                            <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$posts[1]->user->image) }}" alt="Profile Image"></a>

                            <div class="blog-info">
                                <h4 class="title"><a href="#"><b>{{ucwords($posts[1]->title)}}</b></a></h4>

                                <ul class="post-footer">
                                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>138</a></li>
                                </ul>
                            </div><!-- blog-info -->

                        </div><!-- single-post -->

                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$posts[2]->image)}}" alt="{{$posts[2]->title}}"></div>

                            <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$posts[2]->user->image) }}" alt="Profile Image"></a>

                            <h4 class="title"><a href="#"><b>{{ucwords($posts[2]->title)}}</b></a></h4>

                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
                            </ul>

                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-8 col-md-12">
                    <div class="card h-100">
                        <div class="single-post post-style-2">

                            <div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$posts[3]->image)}}" alt="{{$posts[3]->title}}"></div>

                            <div class="blog-info">

                                <h6 class="pre-title">
                                    @foreach($posts[3]->categories as $category)
                                        <a href="#"><b>{{strtoupper($category->name)}}</b></a>
                                    @endforeach
                                </h6>

                                <h4 class="title"><a href="#"><b>{{ucwords($posts[3]->title)}}</b></a></h4>

                                <p>{!!str_limit($posts[3]->body,155,'')!!}</p>

                                <div class="avatar-area">
                                    <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$posts[3]->user->image) }}" alt="Profile Image"></a>
                                    <div class="right-area">
                                        <a class="name" href="#"><b>{{$posts[3]->user->name}}</b></a>
                                        <h6 class="date" href="#">on {{$posts[3]->created_at->format('M d, Y')}} at {{$posts[3]->created_at->format('g:ia')}}</h6>
                                    </div>
                                </div>

                                <ul class="post-footer">
                                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>138</a></li>
                                </ul>

                            </div><!-- blog-right -->

                        </div><!-- single-post extra-blog -->

                    </div><!-- card -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$posts[4]->image)}}" alt="{{$posts[4]->title}}"></div>

                            <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$posts[4]->user->image) }}" alt="Profile Image"></a>

                            <h4 class="title"><a href="#"><b>{{ucwords($posts[4]->title)}}</b></a></h4>

                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
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
                                        <a href="#"><b>{{strtoupper($category->name)}}</b></a>
                                    @endforeach
                                </h6>
                                <h4 class="title"><a href="#"><b>{{$posts[5]->title}}</b></a></h4>

                                <p>{!! str_limit($posts[5]->body,155,'') !!}</p>

                                <div class="avatar-area">
                                    <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$posts[5]->user->image) }}" alt="Profile Image"></a>
                                    <div class="right-area">
                                        <a class="name" href="#"><b>{{$posts[5]->user->name}}</b></a>
                                        <h6 class="date" href="#">on {{$posts[5]->created_at->format('M d, Y')}} at {{$posts[5]->created_at->format('g:ia')}}</h6>
                                    </div>
                                </div>

                                <ul class="post-footer">
                                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>138</a></li>
                                </ul>

                            </div><!-- blog-right -->

                        </div><!-- single-post extra-blog -->

                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$posts[6]->image)}}" alt="{{$posts[6]->title}}"></div>

                            <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$posts[6]->user->image) }}" alt="Profile Image"></a>

                            <div class="blog-info">
                                <h4 class="title"><a href="#"><b>{{ucwords($posts[6]->title)}}</b></a></h4>

                                <ul class="post-footer">
                                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>138</a></li>
                                </ul>
                            </div><!-- blog-info -->

                        </div><!-- single-post -->

                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">

                        <div class="single-post post-style-4">

                            <div class="display-table">
                                <h4 class="title display-table-cell"><a href="#"><b>{{ucwords($posts[7]->title)}}</b></a></h4>
                            </div>

                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
                            </ul>

                        </div><!-- single-post -->

                        <div class="single-post">

                            <div class="display-table">
                                <h4 class="title display-table-cell"><a href="#"><b>{{ucwords($posts[8]->title)}}</b></a></h4>
                            </div>

                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
                            </ul>

                        </div><!-- single-post -->

                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">

                        <div class="single-post post-style-4">

                            <div class="display-table">
                                <h4 class="title display-table-cell"><a href="#"><b>{{ucwords($posts[9]->title)}}</b></a></h4>
                            </div>

                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
                            </ul>

                        </div><!-- single-post -->

                        <div class="single-post">

                            <div class="display-table">
                                <h4 class="title display-table-cell"><a href="#"><b>{{ucwords($posts[10]->title)}}</b></a></h4>
                            </div>

                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
                            </ul>

                        </div><!-- single-post -->

                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-8 col-md-12">
                    <div class="card h-100">
                        <div class="single-post post-style-2">

                            <div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$posts[11]->image)}}" alt="{{$posts[9]->title}}"></div>

                            <div class="blog-info">

                                <h6 class="pre-title">
                                    @foreach($posts[5]->categories as $category)
                                        <a href="#"><b>{{strtoupper($category->name)}}</b></a>
                                    @endforeach
                                </h6>


                                <h4 class="title"><a href="#"><b>{{ucwords($posts[12]->title)}}</b></a></h4>

                                <p>{!! str_limit($posts[12]->body,155,'') !!}</p>

                                <div class="avatar-area">
                                    <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$posts[12]->user->image) }}" alt="Profile Image"></a>
                                    <div class="right-area">
                                        <a class="name" href="#"><b>{{$posts[12]->user->name}}</b></a>
                                        <h6 class="date" href="#">on {{$posts[12]->created_at->format('M d, Y')}} at {{$posts[12]->created_at->format('g:ia')}}</h6>
                                    </div>
                                </div>

                                <ul class="post-footer">
                                    <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>138</a></li>
                                </ul>

                            </div><!-- blog-right -->

                        </div><!-- single-post extra-blog -->

                    </div><!-- card -->
                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

            <a class="load-more-btn" href="#"><b>LOAD MORE</b></a>

        </div><!-- container -->
    </section><!-- section -->
@endsection

@push('js')
    <script src="{{asset('assets/frontend/js/swiper.js')}}"></script>
@endpush