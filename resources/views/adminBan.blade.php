@extends('layouts.app')

@if (isset($user) && !empty($user))
    @section('content')
        <form method="POST" id="adminBan" action="{{route('adminBanSuccess',['id' => $user->user_id])}}">
            @csrf
            <p>ที่อยู่อีเมล {{$user->email}}</p>
            <div class="form-group">
                จำนวนวัน <input type="number" class="form" name="time"> วัน
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
@else
    @section('content')
        <h2>ไม่พบผู้งาน</h2> 
        <a href="{{route('home')}}"><button type="button"  class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
    @endsection  
@endif

@section('script')
    <!-- Javascript Requirements -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\BanForm','#adminBan')!!}
@endsection 