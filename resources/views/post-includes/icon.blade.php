<ul class="post-icons">
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
    <li><a href="#comments"><i class="ion-chatbubble"></i>{{$post->comments()->count()}}</a></li>
    <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
</ul>

