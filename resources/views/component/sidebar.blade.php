@if (Auth::guard('web')->check())
    @if (Auth::user()->user_id === $id)
        <a href="{{route('userData',['id' => Auth::user()->user_id])}}"><p>ข้อมูลอย่างย่อ</p></a>
        <a href="{{route('userEditEmail')}}"><p>แก้ไขอีเมล</p></a>
        <a href="{{route('userEditPassword')}}"><p>แก้ไขรหัสผ่าน</p></a>
        <a href="{{route('userPost')}}"><p>กระทู้ทั้งหมด</p></a>
        <a href="{{route('userComment')}}"><p>ความคิดเห็นทั้งหมด</p></a>
    @endif
@endif
@if (Auth::guard('admin')->check())
    @if ($user->ban)
    <div style="text-align: center;">
        <p>อยู่รหว่างระงับการใช้งาน</p> 
        <p>หมดระยะเวลา</p> 
        @if (isset($user->ban->cancel_at) && !empty($user->ban->cancel_at))
            <p style="font-size:25px;">{{$user->ban->cancel_at->locale('th')->diffForHumans()}}</p>
        @endif
        @if (isset($user->ban->ban_id) && !empty($user->ban->ban_id))
            <a href="{{route('adminBanCancel',['id' => $user->ban->ban_id])}}"><button type="button"  class="btn btn-success">ปลดการระงับใช้งาน</button></a> 
        @endif
    </div>
    @else
        @if (isset($user->user_id) && !empty($user->user_id))
            <a href="{{route('adminBan',['id' => $user->user_id])}}"><button type="button"  class="btn btn-danger">ระงับการใช้งาน</button></a>
        @endif
    @endif
@endif

