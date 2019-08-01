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
                                    @if (isset($post->post_id) && !empty($post->post_id) && isset($post->title) && !empty($post->title))
                                        <a href="{{route('post',['id'=>$post->post_id])}}">{{$post->getLimit($post->title,50)}}</a>
                                    @endif
                                </div>
                                <div class="col-4">
                                    {{$post->time_create}}
                                </div>
                                <div class="col-3">
                                    @if (isset($post->post_id) && !empty($post->post_id))
                                        <a href="{{route('editPost',['id' => $post->post_id])}}"><button type="button"  class="btn btn-primary">แก้ไขกระทู้</button></a>
                                        <a href="{{route('deletePost',['id' => $post->post_id])}}"><button type="button"  class="btn btn-danger">ลบกระทู้</button></a>
                                    @endif
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
        @if ($user)
            <div class="col-2"> 
                @include('component.sidebar',['id' => $user])
            </div>
        @endif

    </div>
</div> 
@if($PostList->isNotEmpty())
    {{$PostList->links()}} 
@endif       
@endsection

