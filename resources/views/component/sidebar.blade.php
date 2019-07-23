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
    <a href="{{route('adminBan',['id' => $user->user_id])}}"><button type="button"  class="btn btn-danger">ระงับการใช้งาน</button></a>
@endif

