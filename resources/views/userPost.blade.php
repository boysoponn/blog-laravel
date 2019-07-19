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
           <h3>กระทู้ของคุณ</h3> 
            @if($PostList->isNotEmpty())
                @foreach ($PostList as $post)
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-5">
                                    <a href="{{route('post',['id'=>$post->post_id])}}">{{Str::limit($post->title, 50)}}</a>
                                </div>
                                <div class="col-4">
                                    {{$post->created_at->setTimezone('Asia/Phnom_Penh')->locale('th')->isoFormat('LLL')}}
                                </div>
                                <div class="col-3">
                                    <a href="{{route('editPost',['id' => $post->post_id])}}"><button type="button"  class="btn btn-primary">แก้ไขกระทู้</button></a>
                                    <a href="{{route('deletePost',['id' => $post->post_id])}}"><button type="button"  class="btn btn-danger">ลบกระทู้</button></a>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p>ยังไม่มีข้อมูล</p>
            @endif    
        </div>
        <div class="col-2"> 
                @include('component.sidebar',['id' => $post->user->user_id])
        </div>
    </div>
</div> 
@if($PostList->isNotEmpty())
    {{$PostList->links()}} 
@endif       
@endsection

