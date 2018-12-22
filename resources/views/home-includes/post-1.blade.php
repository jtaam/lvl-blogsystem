<div class="single-post post-style-1">

            <div class="blog-image"><img
                        src="{{$posts[1]->image}}"
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

