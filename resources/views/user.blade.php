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
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    ชื่อ 
                                </div>
                                <div class="col-6">
                                    {{$user->name}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    กระทู้
                                </div>
                                <div class="col-6">
                                        {{$user->post->count()+$user->comment->count()}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    วันที่สมัคร
                                </div>
                                <div class="col-6">
                                    {{$user->created_at->setTimezone('Asia/Phnom_Penh')->locale('th')->isoFormat('LLL')}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    เข้าสู่ระบบล่าสุด
                                </div>
                                <div class="col-6">
                                    {{$user->last_sign_in_at->setTimezone('Asia/Phnom_Penh')->locale('th')->isoFormat('LLL')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                      
                <div class="col-2"> 
                    @include('component.sidebar',['id' => $user->user_id])
                </div>
        </div>
    </div>      
    @endsection
@else
    @section('content')
        <h2>ไม่พบสมาชิก</h2> 
    @endsection  
@endif