@if (Auth::check())
    @if (Auth::user()->user_id === $id)
        <a href="{{Route('userData',['id' => Auth::user()->user_id])}}"><p>ข้อมูลอย่างย่อ</p></a>
        <a href="{{Route('userEditEmail')}}"><p>แก้ไขอีเมล</p></a>
        <a href="{{Route('userEditPassword')}}"><p>แก้ไขรหัสผ่าน</p></a>
        <a href="{{Route('userPost')}}"><p>กระทู้ทั้งหมด</p></a>
        <a href="{{Route('userComment')}}"><p>ความคิดเห็นทั้งหมด</p></a>
    @endif
@endif

