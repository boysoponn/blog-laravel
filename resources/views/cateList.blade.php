@extends('layouts.app')

    @section('content')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($cateList->isNotEmpty())
            @foreach ($cateList as $cate)
                <div class="alert alert-primary" role="alert">
                    <div class="container">
                        <div class="row">
                            <div class="col-10">
                                    {{$cate->name}}
                            </div>
                            <a href="{{Route('cateDelete',['id' => $cate->category_id])}}">
                                <div class="col-2">
                                    ลบ
                                </div>
                            </a>
                        </div>
                    </div>    
                </div>
            @endforeach
        @endif

        <form method="POST" action="{{route('cateAdd')}}">
            @csrf
            <div class="form-group">
                <label for="cate">เพิ่มประเภท</label>
                <input type="text" class="form-control" name="name" id="cate" >
            </div>
            <div class="form-group">
                    <label for="description">คำอธิบาย</label>
                    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                </div>
            <div class="form-group">
                <button type="submit">ยืนยัน</button>
            </div>
        </form>
    @endsection