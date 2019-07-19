@extends('layouts.app')


@if (Auth::check())
    @if (isset($post)&&!empty($post))
        @if (Auth::user()->user_id === $post->user->user_id)
            @section('content')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                        <li class="breadcrumb-item"><a href="{{route('post',['id' => $post->post_id])}}">{{Str::limit($post->title,10)}}</a></li>
                    </ol>
                </nav>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{route('editPostSuccess',['id' => $post->post_id])}}">
                    @csrf
                    <div class="form-group">
                        <label for="title">หัวข้อ</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
                    </div>
                    <div class="form-group">
                        <label for="content">เนื้อหา</label>
                        <textarea class="form-control" id="content"name="content" rows="15">{{$post->content}}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <select class="custom-select" id="inputGroupSelect04" name="category">
                                @if($cateList->isNotEmpty())
                                    @foreach ($cateList as $item)
                                        <option @if ($cateOld === $item->name) selected @endif value="{{$item->category_id}}">
                                            {{$item->name}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit">ยืนยัน</button>
                    </div>
                </form>
            @endsection
        @endif
    @endif
@else
    @section('content')
        <h2>กรุณาเข้าสู่ระบบ</h2>
        <a href="{{route('login')}}"><button type="button"  class="btn btn-primary">เข้าสู่ระบบ</button></a>
    @endsection  
@endif