<div class="single-post">
    @if (isset($posts[8]))
        <div class="display-table">
            <h4 class="title display-table-cell"><a
                        href="{{route('post.details', $posts[8]->slug)}}"><b>{{ucwords($posts[8]->title)}}</b></a></h4>
        </div>

        <ul class="post-footer">
            <li>@guest
                    <a href="javascript:void(0);"
                       onclick="toastr.info('To add favorite list , you need to login first.','Info',{closeButton:true,progressBar:true})"><i
                                class="ion-heart"></i>{{$posts[8]->favorite_to_users->count()}}</a>
                @else
                    <a href="javascript:void(0);"
                       onclick="document.getElementById('favorite-form-{{$posts[8]->id}}').submit();"
                       class="{{!Auth::user()->favorite_posts->where('pivot.post_id',$posts[8]->id)->count() ==0 ? 'favorite_posts':''}}">
                        <i class="ion-heart"></i>{{$posts[8]->favorite_to_users->count()}}
                    </a>
                    <form id="favorite-form-{{$posts[8]->id}}" method="post"
                          action="{{route('post.favorite',$posts[8]->id)}}"
                          style="display: none;">@csrf</form>
                @endguest</li>
            <li><a href="{{route('post.details',$posts[8]->slug)}}#comments"><i
                            class="ion-chatbubble"></i>{{$posts[8]->comments()->count()}}</a></li>
            <li><a href="#"><i class="ion-eye"></i>{{$posts[8]->view_count}}</a></li>
        </ul>
    @endif
</div><!-- single-post -->
