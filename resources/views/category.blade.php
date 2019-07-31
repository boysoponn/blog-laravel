@extends('layouts.app')

@if (isset($category)&&!empty($category))
    @section('content')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
                @if (isset($category->name) && !empty($category->name))
                    <li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
                @endif
            </ol>
        </nav>
        @if (Auth::guard('web')->check())
            @if (isset($category->name) && !empty($category->name) && isset($category->category_id) && !empty($category->category_id))
                <h2>{{$category->name}} <a href="{{route('addPost',['id' => $category->category_id])}}"><button type="button" class="btn btn-primary">ตั้งกระทู้</button></a></h2>   
            @endif
        @endif
        <hr>

        <table id="datatable" class="table table-hover table-bordered table-striped datatable" style="width:100%">
            <thead>
                <tr>
                    <th>ชื่อกระทูู้</th>
                    <th>โดย</th>
                    <th>ตอบ</th>
                    <th>วันที่</th>
                </tr>
            </thead>
        </table>

    @endsection
@endif    
@section('script')
<script>
    $(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('getCategory') }}",
                data: {
                    id: {{ $category->category_id }}
                }
            },
            columns: [
                    { data: 'title', name: 'title' },
                    { data: 'user_name', name: 'user_name' },
                    { data: 'comments_num', name: 'comments_num' },
                    { data: 'updated_at', name: 'updated_at' }
            ],
        });
    });
</script>
@endsection
