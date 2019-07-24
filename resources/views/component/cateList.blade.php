@if($cateList->isNotEmpty())
    @foreach ($cateList as $cate)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @if (isset($cate->category_id) && !empty($cate->category_id) && isset($cate->name) && !empty($cate->name))
                        <div class="col-4">
                            <a href="{{route('category',['id' => $cate->category_id])}}">{{Str::limit($cate->name, 100)}}</a>
                        </div>
                        @endif
                        @if (isset($cate->description) && !empty($cate->description))
                        <div class="col-3">
                            {{Str::limit($cate->description, 100)}}
                        </div>
                        @endif
                        @if (isset($cate->post) && !empty($cate->post) && isset($cate->comments) && !empty($cate->comments))
                        <div class="col-3">
                            <small>จำนวนหัวข้อ {{$cate->post->count()}}</small>
                            /
                            <small>จำนวนกระทู้ {{$cate->comments->count() + $cate->post->count()}}</small>
                        </div>
                        @endif
                        <div class="col-2">
                            
                            <small> 
                                @if($cate->lastpost->created_at)
                                    ล่าสุด {{$cate->lastpost->created_at->locale('th')->diffForHumans()}} 
                                @endif
                                @if(isset($cate->lastpost->user->user_id) && !empty($cate->lastpost->user->user_id) && isset($cate->lastpost->user->name) && !empty($cate->lastpost->user->name))
                                <a href="{{Route('userData',['id' => $cate->lastpost->user->user_id])}}">
                                    โดย  {{$cate->lastpost->user->name}}
                                </a>
                                @endif
                                @if($cate->lastpost->title && $cate->lastpost->title)
                                    หัวข้อ {{$cate->lastpost->title}}
                                @endif
                            </small>
                            
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
@endif