@if($commentList->isNotEmpty())
    @foreach ($commentList as $comment)
    @if (isset($comment->comment_id) && !empty($comment->comment_id))
        <div class="card" id="{{$comment->comment_id}}">
            <div class="card-body">
                @if (isset($comment->content) && !empty($comment->content))
                    <p class="card-text">{{$comment->content}}</p>
                @endif
                @if (isset($comment->user->user_id) && !empty($comment->user->user_id) && isset($comment->user->name) && !empty($comment->user->name))
                    <small>ตอบกลับโดย <a href="{{Route('userData',['id' => $comment->user->user_id])}}">{{$comment->user->name}}</a></small>
                @endif
                @if (isset($comment->user->post) && !empty($comment->user->comment))
                    <small>จำนวนกระทู้ {{$comment->user->post->count()+$comment->user->comment->count()}}</small>
                    @endif
            </div>
        </div>
    @endif    
    @endforeach
    {{$commentList->links()}}
@endif