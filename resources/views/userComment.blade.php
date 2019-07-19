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
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-4">
                                                    <a href="{{route('category',['id'=>$comment->post->category->category_id])}}">{{$comment->post->category->name}}</a>
                                                    >
                                                    <a href="{{route('post',['id'=>$comment->post->post_id])}}">{{Str::limit($comment->post->title,20)}}</a>
                                            </div>
                                            <div class="col-4">
                                                {{Str::limit($comment->content, 30)}}
                                            </div>
                                            <div class="col-4">
                                                {{$comment->created_at->setTimezone('Asia/Phnom_Penh')->locale('th')->isoFormat('LLL')}}
                                            </div>
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
            <div class="col-2"> 
                    @include('component.sidebar',['id' => $comment->user->user_id])
            </div>
        </div>
    </div>     
    @if($commentList->isNotEmpty())
        {{$commentList->links()}}
    @endif
    @endsection
