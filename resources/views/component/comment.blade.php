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
                            <img style="width:100px;" src="{{asset('uploads/'.$image->user_id.'/'.$image->name)}}" alt="{{$image->upload_id}}">
                        @endforeach
                    </div>
                </div>
            @endif
            <br><br>
            <div>
                @if ($comment->like()->count() === 0)
                    <small>เป็นคนแรกที่ถูกใจสิ่งนี้</small>
                @else
                    <small>{{$comment->like()->count()}}คน ถูกใจสิ่งนี้ </small> 
                    
                @endif 

                @if (Auth::guard('web')->check())
                    @if(isset($likeComment) && !empty($likeComment))
                        @php
                            $check = false;
                            foreach ($likeComment as $item){
                                if ($item->likeable_id === $comment->comment_id){
                                    $check = true;
                                }
                            }   
                        @endphp
                        <div>
                            @if ($check)
                                <a href="{{route('unlikeCommentSuccess',['id' => $comment->comment_id])}}"><button type="button"  class="btn btn-primary">ถูกใจแล้ว</button></a>
                            @else 
                                <a href="{{route('likeCommentSuccess',['id' => $comment->comment_id])}}"><button type="button"  class="btn btn-danger">ถูกใจ</button></a>
                            @endif
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endif    
