<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row">
                @if (isset($post->post_id) && !empty($post->post_id) && isset($post->title) && !empty($post->title) && isset($post->created_at) && !empty($post->created_at))
                    <div class="col-6">
                        <a href="{{route('post',['id' => $post->post_id])}}">{{$post->title}}</a>
                        @if ($post->created_at->diffInDays() < 7)
                            <small>ใหม่</small>
                        @endif
                    </div>
                @endif
                @if (isset($post->user->user_id) && !empty($post->user->user_id) && isset($post->user->name) && !empty($post->user->name))
                    <div class="col-2">
                        โดย <a href="{{Route('userData',['id' => $post->user->user_id])}}">{{$post->user->name}}</a>
                    </div>
                @endif
                @if (isset($post->comment) && !empty($post->comment))
                    <div class="col-2">
                        ตอบ {{$post->comment->count()}}
                    </div>
                @endif
                @if (isset($post->created_at) && !empty($post->created_at))
                    <div class="col-2">
                        วันที่ {{$post->getTimezone($post->created_at)}} 
                    </div>
                @endif
            </div>           
        </div>
    </div>
</div>         