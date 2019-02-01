<div class="single-post post-style-1">
    @if (isset($posts[0]))

    <div class="blog-image"><img
                src="{{$posts[0]->image}}"
                alt="{{$posts[0]->title}}"></div>

    <a class="avatar" href="{{route('author.profile',$posts[0]->user->username)}}">
        <img
                @if (config('app.env') =='production')
                    src="{{$posts[0]->user->image}}"
                @else
                    src="{{ Storage::disk('public')->url('profile/'.$posts[0]->user->image) }}"
                @endif

                alt="Profile Image"></a>
    {{--<a class="avatar" href="{{route('author.profile',$posts[]->user->username)}}"><img src="{{asset('profile/'.$posts[0]->user->image)}}" alt="Profile Image"></a>--}}

    <div class="blog-info">

        <h4 class="title"><a href="{{route('post.details', $posts[0]->slug)}}"><b>{{ucwords($posts[0]->title)}}</b></a>
        </h4>

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
            <li><a href="{{route('post.details',$posts[0]->slug)}}#comments"><i
                            class="ion-chatbubble"></i>{{$posts[0]->comments()->count()}}</a></li>
            <li><a href="#"><i class="ion-eye"></i>{{$posts[0]->view_count}}</a></li>
        </ul>

    </div><!-- blog-info -->
    @endif
</div><!-- single-post -->

