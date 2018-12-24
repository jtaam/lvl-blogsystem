<div class="single-post post-style-2">
    @if (isset($posts[3]))
        <div class="blog-image"><img
                    src="{{Storage::disk('public')->url('post/'.$posts[3]->image)}}"
                    alt="{{$posts[3]->title}}"></div>

        <div class="blog-info">

            <h6 class="pre-title">
                @foreach($posts[3]->categories as $category)
                    <a href="{{route('category.posts',$category->slug)}}"><b>{{strtoupper($category->name)}}</b></a>
                @endforeach
            </h6>

            <h4 class="title"><a href="{{route('post.details', $posts[3]->slug)}}"><b>{{ucwords($posts[3]->title)}}</b></a>
            </h4>

            <p>{!!str_limit($posts[3]->body,155,'')!!}</p>

            <div class="avatar-area">
                <a class="avatar" href="{{route('author.profile',$posts[3]->user->username)}}"><img
                            src="{{ Storage::disk('public')->url('profile/'.$posts[3]->user->image) }}"
                            alt="Profile Image"></a>
                <div class="right-area">
                    <a class="name"
                       href="{{route('author.profile',$posts[3]->user->username)}}"><b>{{$posts[3]->user->name}}</b></a>
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
                <li><a href="{{route('post.details',$posts[3]->slug)}}#comments"><i
                                class="ion-chatbubble"></i>{{$posts[3]->comments()->count()}}</a></li>
                <li><a href="#"><i class="ion-eye"></i>{{$posts[3]->view_count}}</a></li>
            </ul>

        </div><!-- blog-right -->
    @endif
</div><!-- single-post extra-blog -->

