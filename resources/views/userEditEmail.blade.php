@extends('layouts.app')

@if (isset($user) && !empty($user))
    @section('content')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
            </ol>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-10">
                    แก้ไขข้อมูลส่วนตัว
                    <form method="POST" id="userEditEmail" action="{{route('userEditEmailSuccess')}}">
                        @csrf
                        <div class="form-group">
                            ชื่อ : 
                            @if (isset($user->name) && !empty($user->name))
                                {{$user->name}}
                            @else
                                ไม่ทราบชื่อ
                            @endif
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputEmail1">ที่อยู่อีเมล</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" @if (isset($user->email) && !empty($user->email)) value="{{$user->email}}" @endif placeholder="Enter email">
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
@else
    @section('content')
        ไม่พบสมาชิก
    @endsection
@endif

@section('script')
<!-- Javascript Requirements -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\UserEmailForm','#userEditEmail')!!}
@endsection 