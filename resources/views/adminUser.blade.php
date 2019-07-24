@extends('layouts.app')

@section('content')
@if($banList->isNotEmpty())
    <h5>ผุ้ใช้งานที่หมดระยะเวลาระงับการใช้งาน</h5>
    @foreach ($banList as $ban)
        @if (isset($ban->time) && !empty($ban->time) && isset($ban->created_at) && !empty($ban->created_at))
            @if(($ban->time*60*24) < $ban->created_at->diffInMinutes())
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-2">
                                    @if (isset($ban->user->user_id) && !empty($ban->user->user_id) && isset($ban->user->name) && !empty($ban->user->name))
                                        <p>ชื่อผู้ใช้งาน <a href="{{Route('userData',['id' => $ban->user->user_id])}}">{{$ban->user->name}}</a></p> 
                                    @endif
                                </div>
                                <div class="col-4">
                                    @if (isset($ban->description) && !empty($ban->description))
                                        <p>สาเหตุ {{Str::limit($ban->description,100)}}</p> 
                                    @endif
                                </div>
                                <div class="col-2">
                                    @if (isset($ban->cancel_at) && !empty($ban->cancel_at))
                                        <p>ระยะเวลา {{$ban->cancel_at->locale('th')->diffForHumans()}}</p> 
                                    @endif
                                </div>
                                <div class="col-2">
                                    @if (isset($ban->admin->name) && !empty($ban->admin->name))
                                        <p>โดย {{$ban->admin->name}}</p> 
                                    @endif
                                </div>
                                <div class="col-2">
                                    @if (isset($ban->ban_id) && !empty($ban->ban_id))
                                        <a href="{{route('adminBanCancel',['id' => $ban->ban_id])}}"><button type="button"  class="btn btn-success">ปลดการระงับใช้งาน</button></a> 
                                    @endif
                                </div>
                            </div>           
                        </div>
                    </div>
                </div> 
            @endif
        @endif
    @endforeach
    <hr>
    <h5>ผุ้ใช้งานที่อยู่ระหว่างระงับการใช้งาน</h5>
    @foreach ($banList as $ban)
        @if (isset($ban->time) && !empty($ban->time) && isset($ban->created_at) && !empty($ban->created_at))
            @if(($ban->time*60*24) > $ban->created_at->diffInMinutes())
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-2">
                                    @if (isset($ban->user->user_id) && !empty($ban->user->user_id) && isset($ban->user->name) && !empty($ban->user->name))
                                        <p>ชื่อผู้ใช้งาน <a href="{{Route('userData',['id' => $ban->user->user_id])}}">{{$ban->user->name}}</a></p> 
                                    @endif
                                </div>
                                <div class="col-4">
                                    @if (isset($ban->description) && !empty($ban->description))
                                        <p>สาเหตุ {{Str::limit($ban->description,100)}}</p> 
                                    @endif
                                </div>
                                <div class="col-2">
                                    @if (isset($ban->cancel_at) && !empty($ban->cancel_at))
                                        <p>ระยะเวลา {{$ban->cancel_at->locale('th')->diffForHumans()}}</p> 
                                    @endif
                                </div>
                                <div class="col-2">
                                    @if (isset($ban->admin->name) && !empty($ban->admin->name))
                                        <p>โดย {{$ban->admin->name}}</p> 
                                    @endif
                                </div>
                                <div class="col-2">
                                    @if (isset($ban->ban_id) && !empty($ban->ban_id))
                                        <a href="{{route('adminBanCancel',['id' => $ban->ban_id])}}"><button type="button"  class="btn btn-success">ปลดการระงับใช้งาน</button></a> 
                                    @endif
                                </div>
                            </div>           
                        </div>
                    </div>
                </div> 
            @endif
        @endif
    @endforeach
@endif
@endsection
