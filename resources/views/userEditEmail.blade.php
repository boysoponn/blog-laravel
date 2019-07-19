@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
        </ol>
    </nav>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-10">
                แก้ไขข้อมูลส่วนตัว
                <form method="POST" action="{{route('userEditEmailSuccess')}}">
                    @csrf
                    <div class="form-group">
                        ชื่อ : {{$user->name}}
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputEmail1">ที่อยู่อีเมล</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{$user->email}}" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="old Password">รหัสผ่าน</label>
                        <input type="password" class="form-control" id="old Password" name="password" placeholder="Password">
                    </div>
                <button type="submit" class="btn btn-primary">ยืนยัน</button>
                </form>
            </div>
            <div class="col-2"> 
                    @include('component.sidebar',['id' => $user->user_id])
            </div>
        </div>
    </div>      
@endsection
