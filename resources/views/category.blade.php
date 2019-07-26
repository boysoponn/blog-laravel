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
        @if($postList->isNotEmpty())
        <table id="postListCate">
            <thead>
                <tr>
                    <th>{{$category->name}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postList as $post)
                <tr>  
                    <td>
                        @include('component.postListCate',['post' => $post])
                    </td> 
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>ยังไม่มีกระทู้ใดๆ</p>
        @endif
    @endsection
@endif    
@section('script')
    <script>
        $(document).ready( function () {
            $('#postListCate').DataTable();
        } );
    </script>
@endsection
