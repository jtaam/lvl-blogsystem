<div class="container">
    <h4><b>POST COMMENT</b></h4>
    <div class="row">

        <div class="col-lg-8 col-md-12">
            <div class="comment-form">
                @guest
                    <p>Please, <a href="{{route('login')}}" class="text-info">Login</a> to comment.</p>
                @else
                    <form method="post" action="{{route('comment.store',$post->id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                        <textarea name="comment" rows="2" class="text-area-messge form-control"
                                                  placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                            </div><!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                            </div><!-- col-sm-12 -->

                        </div><!-- row -->
                    </form>
                @endguest
            </div><!-- comment-form -->

            <h4><b>COMMENTS({{$post->comments()->count()}})</b></h4>

            @if($post->comments->count() > 0)
                @foreach($post->comments as $comment)
                    <div class="commnets-area ">

                        <div class="comment">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$comment->user->image) }}" alt="{{$comment->user->name}}"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{$comment->user->name}}</b></a>
                                    <h6 class="date">on {{$post->created_at->format('M d, Y')}} at {{$post->created_at->format('g:ia')}}</h6>
                                </div>

                            </div><!-- post-info -->

                            <p>{!! $comment->comment !!}</p>

                        </div>

                    </div><!-- commnets-area -->
                @endforeach
            @else
                <div class="commnets-area ">

                    <div class="comment">

                        <div class="post-info">
                            <p>No comment on this post yet. Be the first!</p>
                        </div>
                    </div>
                </div>
            @endif

        </div><!-- col-lg-8 col-md-12 -->

    </div><!-- row -->

</div><!-- container -->
