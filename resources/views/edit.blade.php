@extends('layouts.app')

@if (Auth::guard('web')->check())
    @if (isset($post)&&!empty($post))
        @if (Auth::user()->user_id === $post->user->user_id)
            @section('content')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                        <li class="breadcrumb-item"><a href="{{route('post',['id' => $post->post_id])}}">{{Str::limit($post->title,10)}}</a></li>
                    </ol>
                </nav>
                <form method="POST" id="edit" action="{{route('editPostSuccess',['id' => $post->post_id])}}">
                    @csrf
                    <div class="form-group">
                        <label for="title">หัวข้อ</label>
                    <input type="text" class="form-control" id="title" name="title" @if (isset($post->title) && !empty($post->title)) value="{{$post->title}}" @endif >
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
                        <label for="content">เนื้อหา</label>
                        <textarea class="form-control" id="content"name="content" rows="15">@if (isset($post->content) && !empty($post->content)) {{$post->content}} @endif</textarea>
                    </div>
                    <hr>
                    <a href="{{route('upload')}}">อัพโหลด</a>
                    <hr>
                    @if($imageList->isNotEmpty())
                        <table id="imageList">
                            <thead>
                                <tr>
                                    <th>choose</th>
                                    <th>image</th>
                                    <th>name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($imageList as $image)
                                <tr>  
                                    <td>
                                        @php
                                            $checked = false;
                                            if ($imageUpload->keys()->contains($image->upload_id)) {
                                                $checked = true;
                                            }
                                        @endphp
                                        <input type="checkbox" id={{$image->upload_id}} name='file[]' aria-label="Checkbox for following text input" value="{{$image->upload_id}} " @if ($checked) checked @endif> 
                                    </td> 
                                    <td>
                                        <img width='50px' id={{$image->upload_id}} src="{{asset('uploads/'.Auth::user()->user_id.'/'.$image->name)}}" alt="">
                                    </td> 
                                    <td>
                                        <p>{{$image->name}}</p>
                                    </td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <hr>
                    <div class="form-group">
                        <button class="btn btn-secondary" type="submit">ยืนยัน</button>
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

@section('script')
<script>
    $(document).ready( function () {
        $('#imageList').DataTable();
    } );
</script>
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\PostForm','#edit')!!}
@endsection 