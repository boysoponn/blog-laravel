@extends('layouts.app')

@if (isset($post) && !empty($post))
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
            @if (isset($post->category->category_id) && !empty($post->category->category_id) && isset($post->category->name) && !empty($post->category->name))
                <li class="breadcrumb-item"><a href="{{route('category',['id' => $post->category->category_id])}}">{{$post->category->name}}</a></li>
            @else
                <li class="breadcrumb-item active" aria-current="page">ไม่ระบุประเภท</li>
            @endif
            @if (isset($post->title) && !empty($post->title))
                <li class="breadcrumb-item active" aria-current="page">{{$post->getLimit($post->title,10)}}</li>
            @endif
        </ol>
    </nav>
    @include('component.post',['post' => $post])
    <hr>

    @if (Auth::guard('web')->check())
        <form method="POST" id="comment" action="{{route('commentSuccess',['id' => $post->post_id])}}">
            @csrf
            <div class="form-group">
                <label for="comment">ความคิดเห็น</label>
                <textarea class="form-control" name="content" id="comment" rows="3"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-secondary" type="submit">ยืนยัน</button>
            </div>
        </form>
    @endif
    <hr>
    <table id="commentList" class="table table-hover table-bordered table-striped datatable" style="width:100%">
        <thead>
            <tr>
                <th>ความคิดเห็น</th>
                <th>โดย</th>
            </tr>
        </thead>
    </table>
@endsection
@else
    @section('content')
        <h2>ไม่พบกระทู้ดังกล่าว</h2> 
        <a href="{{route('home')}}"><button type="button"  class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
    @endsection  
@endif

@section('script')
<script>
    $(function() {
        $('#commentList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('getComment') }}",
                data: {
                    id: {{ $post->post_id }}
                }
            },
            columns: [
                    { data: 'content', name: 'content' },
                    { data: 'user', name: 'user' },
            ],
        });
    });
</script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\CommentForm','#comment')!!}
@endsection 