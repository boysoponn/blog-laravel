@if($cateList->isNotEmpty())
    @foreach ($cateList as $cate)
            <div class="card">
                <div class="card-body">
                    <div class="container">
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
                                @if($cate->lastpost)
                                <small> ล่าสุด {{$cate->lastpost->created_at->locale('th')->diffForHumans()}} โดย 
                                    <a href="{{Route('userData',['id' => $cate->lastpost->user->user_id])}}">
                                        {{$cate->lastpost->user->name}}
                                    </a>
                                    หัวข้อ {{$cate->lastpost->title}}
                                </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
@endif