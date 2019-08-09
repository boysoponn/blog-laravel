
<div class="modal-header">
    {{$post->like_count}}คน ถูกใจสิ่งนี้ 
</div>
<div class="modal-body" style="height: 300px; overflow-y:auto;">
    @if ($post->like->isNotEmpty())
        @foreach ($post->like as $like)
            <a href="{{route('userData',['id' => $like->user->user_id])}}"><p>{{$like->user->name}}</p></a>
        @endforeach
    @endif
</div>