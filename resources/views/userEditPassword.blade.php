@extends('layouts.app')

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
                <form method="POST" id="userEditPassword" action="{{route('userEditPasswordSuccess')}}">
                    @csrf
                    <div class="form-group">
                        ชื่อ : {{$user->name}}
                    </div> 
                    <div class="form-group">
                        <label for="old Password">รหัสผ่านเดิม</label>
                        <input type="password" class="form-control" id="old Password" name="oldpassword" placeholder="Old Password">
                        </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">รหัสผ่านใหม่</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="newpassword" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="confirm">ยืนยันรหัสผ่านใหม่</label>
                        <input type="password" class="form-control" id="confirm" name="confirmpassword" placeholder="Confirm New Password">
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

@section('script')
<!-- Javascript Requirements -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\UserPasswordForm','#userEditPassword')!!}
@endsection 