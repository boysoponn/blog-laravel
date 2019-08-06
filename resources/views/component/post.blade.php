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
            @if($post->upload->isNotEmpty())
                <div style="text-align:center">
                    @foreach ($post->upload as $image)
                        @if (isset($image) && !empty($image))
                            <img style="width:50%;" src="{{asset('uploads/'.$image->user_id.'/'.$image->name)}}" alt="{{$image->upload_id}}">
                        @endif
                    @endforeach 
                </div>        
            @endif
            @if (isset($post->user->user_id) && !empty($post->user->user_id) && isset($post->user->name) && !empty($post->user->name))
                <small>โดย <a href="{{route('userData',['id' => $post->user->user_id])}}">{{$post->user->name}}</a></small>
            @endif
            <hr>
            <div>
                @if ($post->like()->count() === 0)
                <p>เป็นคนแรกที่ถูกใจสิ่งนี้</p>
                @else
                    <p style="cursor: pointer" data-toggle="modal" data-target="#exampleModalCenter3">{{$post->like()->count()}}คน ถูกใจสิ่งนี้ </p>  
                    @include('component.modelLike',['likeList'=> $post->like])
                @endif 

                @if (Auth::guard('web')->check())
                    @if (isset($likePost) && !empty($likePost))
                        <a href="{{route('unlikePostSuccess',['id' => $post->post_id])}}"><button type="button"  class="btn btn-primary">ถูกใจแล้ว</button></a>
                    @else
                        <a href="{{route('likePostSuccess',['id' => $post->post_id])}}"><button type="button"  class="btn btn-danger">ถูกใจ</button></a>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endif