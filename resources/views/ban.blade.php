@extends('layouts.app')

@section('content')
<div class="card">
    @if (isset($ban->user->email) && !empty($ban->user->email))
        <h5 class="card-header">ที่อยู่อีเมล {{$ban->user->email}} ถูกระงับการใช้งาน</h5>
        <div class="card-body">
            <h5 class="card-title">รายละเอียด</h5>
            @if (isset($ban->cancel_at) && !empty($ban->cancel_at))
            @if(($ban->time*60*24) < $ban->created_at->diffInMinutes())
                <p class="card-text">เวลาที่เหลือ 0 ชั่วโมง </p>
            @else
                <p class="card-text">เวลาที่เหลือ {{$ban->cancel_at->diffInHours()}} ชั่วโมง </p>
            @endif   
                <p class="card-text">ปลดแบนวันที่ {{$ban->time_cancel_at}}</p>
            @endif
            @if (isset($ban->description) && !empty($ban->description))
                <p class="card-text">สาเหตุ {{$ban->description}}</p>
            @endif
            <a href="{{route('home')}}" class="btn btn-primary">ไปหน้าแรก</a>
        </div>
    @endif
</div>
@endsection
