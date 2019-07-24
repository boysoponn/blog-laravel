@if (isset($post) && !empty($post))
    @if (Auth::guard('web')->check())
        @if ($post->user->user_id === Auth::user()->user_id)
            <div style="margin-bottom:20px">
                @if (isset($post->post_id) && !empty($post->post_id))
                    <a href="{{route('editPost',['id' => $post->post_id])}}"><button type="button"  class="btn btn-primary">แก้ไขกระทู้</button></a>
                    <a href="{{route('deletePost',['id' => $post->post_id])}}"><button type="button"  class="btn btn-danger">ลบกระทู้</button></a>
                @endif
            </div>  
        @endif
    @endif
    @if ($admin)
        <div style="margin-bottom:20px">
            @if (isset($post->post_id) && !empty($post->post_id))
                <a href="{{route('deletePostByadmin',['id' => $post->post_id])}}"><button type="button"  class="btn btn-danger">ลบกระทู้</button></a>
            @endif
        </div>  
    @endif
    <div class="card">
        <div class="card-body">
            @if (isset($post->title) && !empty($post->title))
                <h5 class="card-title">{{$post->title}}</h5>
            @endif
            @if (isset($post->content) && !empty($post->content))
                <p class="card-text">{{$post->content}}</p>
            @endif
            @if (isset($post->user->user_id) && !empty($post->user->user_id) && isset($post->user->name) && !empty($post->user->name))
                <small>โดย <a href="{{Route('userData',['id' => $post->user->user_id])}}">{{$post->user->name}}</a></small>
            @endif
        </div>
    </div>
@endif