<h4 class="title"><b>TAGS</b></h4>
<ul class="tags">
    @foreach($post->tags as $tag)
        <li><a href="{{route('tag.posts',$tag->slug)}}">{{ucwords($tag->name)}}</a></li>
    @endforeach
</ul>