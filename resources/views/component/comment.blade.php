@if (isset($comment) && !empty($comment))
    <div class="card">
        <div class="card-body">
            @if (isset($comment->content) && !empty($comment->content))
                <p class="card-text">{{$comment->content}}</p>
            @endif
            @if (isset($comment->user->user_id) && !empty($comment->user->user_id) && isset($comment->user->name) && !empty($comment->user->name))
                <small>ตอบกลับโดย <a href="{{Route('userData',['id' => $comment->user->user_id])}}">{{$comment->user->name}}</a></small>
            @endif
            @if (isset($comment->user->post) && !empty($comment->user->comment))
                <small>จำนวนกระทู้ {{$comment->user->post_count + $comment->user->comment_count}}</small>
            @endif
            @if ($admin)
                <div style="margin-bottom:20px">
                    @if (isset($comment->comment_id) && !empty($comment->comment_id))
                        <a href="{{route('deleteCommentByadmin',['id' => $comment->comment_id])}}"><button type="button"  class="btn btn-danger">ลบความเห็น</button></a>
                    @endif
                </div>  
            @endif
            @if ($comment->upload->isNotEmpty())
                <div>
                    <small>รูปภาพที่แนบมา</small>
                    <div>
                        @foreach ($comment->upload as $image)
                            <img style="height:200px;" src="{{asset('uploads/'.$image->user_id.'/'.$image->name)}}" alt="{{$image->upload_id}}">
                        @endforeach
                    </div>
                </div>
            @endif
            <br><br>
            <div>
                @if (Auth::guard('web')->check())
                    <i data-comment="{{$comment->comment_id}}" style="color:red; font-size:20px; cursor: pointer;" class="likeComment @if($comment->like->isNotEmpty()) fas @else far @endif fa-heart"></i>
                    <span id={{"textLikeComment".$comment->comment_id}}  class="textComment" data-comment="{{$comment->comment_id}}" style="cursor: pointer; font-size:16px" data-toggle="modal" data-target="#exampleModalCenter3">@if ($comment->like_count > 0) {{$comment->like_count}} @else เป็นคนแรกที่ถูกใจสิ่งนี้ @endif</span>  
                @else
                    <i  style="color:red; font-size:20px" class="fas fa-heart"></i>
                    <span style="font-size:20px">{{$comment->like_count}}</span>  
                @endif
            </div>
        </div>
    </div>
@endif    
