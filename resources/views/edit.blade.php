@extends('layouts.app')

@if (Auth::guard('web')->check())
    @if (isset($post)&&!empty($post))
        @if (Auth::user()->user_id === $post->user->user_id)
            @section('content')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                        <li class="breadcrumb-item"><a href="{{route('post',['id' => $post->post_id])}}">{{$post->getLimit($post->title,10)}}</a></li>
                    </ol>
                </nav>
                <form method="POST" id="edit" action="{{route('editPostSuccess',['id' => $post->post_id])}}">
                    @csrf
                    <p>กระทู้</p>
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
                        <label for="title">หัวข้อ</label>
                        <input type="text" class="form-control" id="title" name="title" @if (isset($post->title) && !empty($post->title)) value="{{$post->title}}" @endif >
                    </div>
                    <div class="form-group">
                        <label for="content">เนื้อหา</label>
                        <textarea class="form-control" id="content"name="content" rows="15">@if (isset($post->content) && !empty($post->content)) {{$post->content}} @endif</textarea>
                    </div>
                    <hr>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">แนบรูปภาพ</button>
                    @include('component.imageList',['imageList' => $imageList])
                    <hr>
                    <div class="form-group">
                        <button class="btn btn-secondary" type="submit">ยืนยัน</button>
                    </div>
                </form>
                @include('component.upload')
            @endsection
        @endif
    @endif
@else
    @section('content')
        <h2>กรุณาเข้าสู่ระบบ</h2>
        <a href="{{route('login')}}"><button type="button"  class="btn btn-primary">เข้าสู่ระบบ</button></a>
    @endsection  
@endif

@section('script')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\PostForm','#edit')!!}
{!! JsValidator::formRequest('App\Http\Requests\UploadForm','#upload')!!}
@endsection 