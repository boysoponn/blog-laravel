@extends('layouts.app')

    @section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
        </ol>
    </nav>
        <form method="POST" id="addpost" action="{{route('addPostSuccess')}}">
                @csrf
                <div class="form-group">
                    <label for="title">ชื่อกระทู้</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="content">เนื้อหา</label>
                    <textarea class="form-control" id="content" rows="15" name="content"></textarea>
                </div>
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
                    <button type="submit">ยืนยัน</button>
                </div>
            </form>
    @endsection 

    @section('script')
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\PostForm','#addpost')!!}
    @endsection 
