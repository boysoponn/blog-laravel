@extends('layouts.app')

@section('content')
    <h2>กระทู้</h2>
    @if($cateList->isNotEmpty())
        @if (Auth::check())
            <a href="{{route('addPost',['id' => $cateList->first()->category_id])}}"><button type="button"  class="btn btn-primary">ตั้งกระทู้</button></a>
        @endif
    @endif
    <hr>
    @if($postList->isNotEmpty())
        <div class="container">
            @include('component.postList',['postList' => $postList])
        </div>
    @endif        
    <hr>
    <h2>ประเภท</h2>
    @if (Auth::check())
        <a href="{{route('cate')}}"><button type="button"  class="btn btn-primary">เพิ่มประเภท</button></a>
    @endif
    <hr>
    @if($cateList->isNotEmpty())
        <div class="container">
            @include('component.cateList',['cateList' => $cateList])
        </div>
    @endif
@endsection
