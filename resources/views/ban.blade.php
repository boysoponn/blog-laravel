@extends('layouts.app')

@section('content')
<div class="card">
    @if (isset($ban->user->email) && !empty($ban->user->email))
        <h5 class="card-header">ที่อยู่อีเมล {{$ban->user->email}} ถูกระงับการใช้งาน</h5>
        <div class="card-body">
            <h5 class="card-title">รายละเอียด</h5>
            @if (isset($ban->cancel_at) && !empty($ban->cancel_at))
                <p class="card-text">ระยะเวลา {{$ban->cancel_at->diffInHours()}} ชั่วโมง </p>
                <p class="card-text">ปลดแบนวันที่ {{$ban->cancel_at->locale('th')->isoFormat('LLL')}}</p>
            @endif
            @if (isset($ban->description) && !empty($ban->description))
                <p class="card-text">สาเหตุ {{$ban->description}}</p>
            @endif
            <a href="{{route('home')}}" class="btn btn-primary">ไปหน้าแรก</a>
        </div>
    @endif
</div>
@endsection
