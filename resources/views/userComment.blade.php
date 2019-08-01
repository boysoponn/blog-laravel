@extends('layouts.app')

    @section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-10">
               <h3>ความคิดเห็นของคุณ</h3> 
                @if($commentList->isNotEmpty())
                    @foreach ($commentList as $comment)
                        @if (isset($comment) && !empty($comment))
                            <div class="card">
                                <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                @if (isset($comment->post->category->category_id) && !empty($comment->post->category->category_id) && isset($comment->post->category->name) && !empty($comment->post->category->name))
                                                    <a href="{{route('category',['id'=>$comment->post->category->category_id])}}">{{$comment->post->category->name}}</a>
                                                @else
                                                    <a>ไม่ระบุประเภท</a>
                                                @endif
                                                    >
                                                @if (isset($comment->post->post_id) && !empty($comment->post->post_id) && isset($comment->post->title) && !empty($comment->post->title))
                                                    <a href="{{route('post',['id'=>$comment->post->post_id])}}">{{$comment->getLimit($comment->post->title,20)}}</a>
                                                @else
                                                    <a>ไม่ทราบกระทู้</a>
                                                @endif
                                            </div>
                                            <div class="col-4">
                                                @if (isset($comment->content) && !empty($comment->content))
                                                    {{$comment->getLimit($comment->content, 30)}}
                                                @endif
                                            </div>
                                            <div class="col-4">
                                                @if (isset($comment->created_at) && !empty($comment->created_at))
                                                    {{$comment->time_create}}
                                                @endif
                                            </div>
                                        </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p>ยังไม่มีข้อมูล</p>
                @endif
            </div>
            @if ($user)
                <div class="col-2"> 
                        @include('component.sidebar',['id' => $user])
                </div>
            @endif
        </div>
    </div>     
    @if($commentList->isNotEmpty())
        {{$commentList->links()}}
    @endif
    @endsection
