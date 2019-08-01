@extends('layouts.app')

    @section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
        </ol>
    </nav>
        <form method="POST" id="addpost" action="{{route('addPostSuccess')}}">
            @csrf
            <p>ประเภท</p>
            <div class="form-group">
                <div class="input-group">
                    <select class="custom-select" id="inputGroupSelect04" name="category">
                        @if($cateList->isNotEmpty())
                            @foreach ($cateList as $item)
                                <option  value="{{$item->category_id}}" @if ($cateOld == $item->category_id) selected @endif>
                                    {{$item->name}}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="title">ชื่อกระทู้</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="content">เนื้อหา</label>
                <textarea class="form-control" id="content" rows="15" name="content"></textarea>
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

    @section('script')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\PostForm','#addpost')!!}
    {!! JsValidator::formRequest('App\Http\Requests\UploadForm','#upload')!!}
    @endsection 
