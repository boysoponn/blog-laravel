@extends('layouts.app')

    @section('content')
        @if (isset($cate->category_id) && !empty($cate->category_id))
            <form method="POST" id="editCate" action="{{route('cateEditSuccess',['id'=>$cate->category_id])}}">
                @csrf
                <div class="form-group">
                    <label for="cate">ชื่อประเภท</label>
                    <input type="text" class="form-control" name="name" id="cate" @if (isset($cate->name) && !empty($cate->name)) value="{{$cate->name}}" @endif>
                </div>
                <div class="form-group">
                        <label for="description">คำอธิบาย</label>
                        <textarea class="form-control" id="description" rows="3" name="description">@if (isset($cate->description) && !empty($cate->description)) {{$cate->description}} @endif</textarea>
                    </div>
                <div class="form-group">
                    <button type="submit">ยืนยัน</button>
                </div>
            </form>
        @endif
    @endsection

    @section('script')

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\CateForm','#editCate')!!}
    @endsection 