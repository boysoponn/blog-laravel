@if($postList->isNotEmpty())
    @foreach ($postList as $post)
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        @if (isset($post->title) && !empty($post->title) && isset($post->created_at) && !empty($post->created_at) && isset($post->post_id) && !empty($post->post_id))
                            <div class="col-5">
                                <a href="{{route('post',['id' => $post->post_id])}}">{{$post->getLimit($post->title,50)}}</a>
                                
                                @if ($post->created_at->diffInDays() < 7)
                                    <small>ใหม่</small>
                                @endif
                            </div>
                        @endif
                        @if (isset($post->user->user_id) && !empty($post->user->user_id) && isset($post->user->name) && !empty($post->user->name))
                            <div class="col-3">
                                <p>โดย <a href="{{Route('userData',['id' => $post->user->user_id])}}">{{$post->user->name}}</a></p>
                            </div>
                        @endif
                        @if (isset($post->category->category_id) && !empty($post->category->category_id) && isset($post->category->name) && !empty($post->category->name))
                            <div class="col-2">
                                <a href="{{route('category',['id' => $post->category->category_id])}}">{{$post->category->name}}</a>
                            </div>
                        @else
                            <div class="col-2">
                                <a>ไม่ระบุประเภท</a>
                            </div>
                        @endif
                            <div class="col-2">
                                @if (isset($post->created_at) && !empty($post->created_at))
                                    <small>วันที่ {{$post->time_create}}</small> 
                                @endif
                                @if ( isset($post->like_count) && !empty($post->like_count))
                                    @if ($post->like_count > 0)
                                        <small><i style="color:red;" class="fas fa-heart"></i> {{$post->like_count}}</small>
                                    @endif
                                @endif
                                @if ( isset($post->comment_count) && !empty($post->comment_count))
                                    @if ($post->comment_count > 0)
                                        <small><i style="color:#15aabf;" class="fas fa-comments "></i> {{$post->comment_count}} </small>  
                                    @endif
                                @endif
                            </div>
                        
                    </div>           
                </div>
            </div>
        </div>         
    @endforeach
@endif