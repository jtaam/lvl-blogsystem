@extends('layouts.frontend.app')

@section('title','Home')

@push('css')
    <link href="{{asset('assets/frontend/css/home/styles.css')}}" rel="stylesheet">

    <link href="{{asset('assets/frontend/css/home/responsive.css')}}" rel="stylesheet">

    <style>
        .favorite_posts {
            color: blue;
        }

        .category-top-image {
            height: 203px;
        }
    </style>
@endpush

@section('content')
    @include('home-includes.main-slider')

    <section class="blog-area section">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        @include('home-includes.post-0')
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        @include('home-includes.post-1')
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        @include('home-includes.post-2')
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-8 col-md-12">
                    <div class="card h-100">
                        @include('home-includes.post-3')
                    </div><!-- card -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        @include('home-includes.post-4')
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        @include('home-includes.post-5')
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        @include('home-includes.post-6')
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        @include('home-includes.post-7')

                        @include('home-includes.post-8')
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">

                        @include('home-includes.post-9')

                        @include('home-includes.post-10')

                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-8 col-md-12">
                    <div class="card h-100">
                        @include('home-includes.post-11')
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