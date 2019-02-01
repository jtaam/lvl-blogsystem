<div class="container">
    <div class="row">
        @foreach($randomPosts as $randomPost)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="
                            @if($category->public_id == null)
                                {{Storage::disk('public')->url('post/'.$randomPost->image)}}
                            @else
                                {{$randomPost->image}}
                            @endif
                            " alt="{{$randomPost->title}}"></div>

                        <a class="avatar" href="{{route('author.profile',$randomPost->user->username)}}"><img src="{{ Storage::disk('public')->url('profile/'.$randomPost->user->image) }}" alt="{{$randomPost->user->name}}"></a>

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