<div class="single-post post-style-2 post-style-3">

    <div class="blog-info">

        <h6 class="pre-title">
            @foreach($posts[5]->categories as $category)
                <a href="{{route('category.posts',$category->slug)}}"><b>{{strtoupper($category->name)}}</b></a>
            @endforeach
        </h6>
        <h4 class="title"><a href="{{route('post.details', $posts[5]->slug)}}"><b>{{ucwords($posts[5]->title)}}</b></a>
        </h4>

        <p>{!! str_limit($posts[5]->body,155,'') !!}</p>

        <div class="avatar-area">
            <a class="avatar" href="{{route('author.profile',$posts[5]->user->username)}}"><img
                        src="{{ Storage::disk('public')->url('profile/'.$posts[5]->user->image) }}"
                        alt="Profile Image"></a>
            <div class="right-area">
                <a class="name"
                   href="{{route('author.profile',$posts[5]->user->username)}}"><b>{{$posts[5]->user->name}}</b></a>
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
            <li><a href="{{route('post.details',$posts[5]->slug)}}#comments"><i
                            class="ion-chatbubble"></i>{{$posts[5]->comments()->count()}}</a></li>
            <li><a href="#"><i class="ion-eye"></i>{{$posts[5]->view_count}}</a></li>
        </ul>

    </div><!-- blog-right -->

</div><!-- single-post extra-blog -->

