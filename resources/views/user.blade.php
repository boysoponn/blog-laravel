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
                <div class="card text-center">
                    <div class="card-header">
                        ข้อมูลอย่างย่อ
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                ชื่อ 
                            </div>
                            <div class="col-6">
                                @if (isset($user->name) && !empty($user->name))
                                    {{$user->name}}
                                @else
                                    ไม่ทราบชื่อ
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                กระทู้
                            </div>
                            <div class="col-6">
                                @if (isset($user->post) && !empty($user->post) && isset($user->comment) && !empty($user->comment))
                                    {{$user->post->count()+$user->comment->count()}}
                                @else
                                    ไม่ทราบจำนวนกระทู้
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                วันที่สมัคร
                            </div>
                            <div class="col-6">
                                @if (isset($user->created_at) && !empty($user->created_at))
                                    {{$user->getTimezone($user->created_at)}}
                                @else
                                    ไม่ทราบวันที่สมัคร
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                เข้าสู่ระบบล่าสุด
                            </div>
                            <div class="col-6">
                                @if (isset($user->last_sign_in_at) && !empty($user->last_sign_in_at))
                                    {{$user->getTimezone($user->last_sign_in_at)}}
                                @else
                                    ไม่ทราบเวลาเข้าสู่ระบบล่าสุด
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>                      
                <div class="col-2"> 
                    @include('component.sidebar',['id' => $user->user_id])
                </div>
        </div>

        @if($admin)
        <div class="row" style="margin-top:10px;">
            <div class="col-10">
                <h5>ประวัติการระงับการใช้งาน</h5>
                @if($banList->isNotEmpty())
                    @foreach ($banList as $key=>$ban)
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <p>ครั้งที่ {{$key+1}} </p>
                                </div>
                                <div class="col-4">
                                    @if (isset($ban->description) && !empty($ban->description))
                                        <p>สาเหตุ {{$ban->getLimit($ban->description,100)}}</p>
                                    @else
                                        ไม่ทราบสาเหตุ
                                    @endif
                                </div>
                                <div class="col-1">
                                    @if (isset($ban->time) && !empty($ban->time))
                                    <p>{{$ban->time}} วัน</p>
                                    @else
                                        ไม่ทราบเวลา
                                    @endif
                                </div>
                                <div class="col-2">
                                    @if (isset($ban->admin->name) && !empty($ban->admin->name))
                                        <p>โดย {{$ban->admin->name}}</p>
                                    @else
                                        ไม่ทราบชื่อ
                                    @endif
                                </div>
                                <div class="col-3">
                                    @if (isset($ban->deleted_at) && !empty($ban->deleted_at))
                                        <p>ปลดระงับการใช้งานแล้ว</p>
                                    @else
                                        <p>กำลังถูกระงับการใช้งาน</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p>ไม่มีประวัติการถูกระงับใช้งาน</p>
                @endif
            </div>
        </div>         
        @endif
    </div>      
    @endsection
@else
    @section('content')
        <h2>ไม่พบสมาชิก</h2> 
    @endsection  
@endif