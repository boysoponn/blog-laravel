@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">ที่อยู่อีเมล {{$ban->user->email}} ถูกระงับการใช้งาน</h5>
    <div class="card-body">
        <h5 class="card-title">รายละเอียด</h5>
        <p class="card-text">ระยะเวลา {{$ban->cancel_at->diffInHours()}} ชั่วโมง </p>
        <p class="card-text">ปลดแบนวันที่ {{$ban->cancel_at}}</p>
        <p class="card-text">สาเหตุ {{$ban->description}}</p>
        <a href="{{route('home')}}" class="btn btn-primary">ไปหน้าแรก</a>
    </div>
</div>
@endsection
