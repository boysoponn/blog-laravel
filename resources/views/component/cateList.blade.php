@if($cateList->isNotEmpty())
    @foreach ($cateList as $cate)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            @if (isset($cate->category_id) && !empty($cate->category_id) && isset($cate->name) && !empty($cate->name))
                            <a href="{{route('category',['id' => $cate->category_id])}}">{{$cate->getLimit($cate->name, 100)}}</a>
                            @endif
                        </div>
                        <div class="col-3">
                            @if (isset($cate->description) && !empty($cate->description))
                                {{$cate->getLimit($cate->description, 100)}}
                            @endif
                        </div>
                       
                        <div class="col-3">
                            @if (isset($cate->post) && !empty($cate->post) && isset($cate->comments) && !empty($cate->comments))
                                <small>จำนวนหัวข้อ {{$cate->post_count}}</small>
                                /
                                <small>จำนวนกระทู้ {{$cate->comments_count + $cate->post_count}}</small>
                            @endif
                        </div>
                        <div class="col-2">

                            <small> 
                                @if (isset($cate->lastpost->created_at) && !empty($cate->lastpost->created_at))
                                    ล่าสุด {{$cate->diffentTime($cate->lastpost->created_at)}} 
                                @endif
                                @if(isset($cate->lastpost->user->user_id) && !empty($cate->lastpost->user->user_id) && isset($cate->lastpost->user->name) && !empty($cate->lastpost->user->name))
                                โดย
                                <a href="{{Route('userData',['id' => $cate->lastpost->user->user_id])}}">
                                      {{$cate->lastpost->user->name}}
                                </a>
                                @endif
                                @if (isset($cate->lastpost->title) && !empty($cate->lastpost->title))
                                    หัวข้อ 
                                    <a href="{{Route('post',['id' => $cate->lastpost->post_id])}}">
                                        {{$cate->getLimit($cate->lastpost->title,10)}}
                                    </a>
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
@endif