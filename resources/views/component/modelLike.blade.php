@if ($likeList->isNotEmpty())
    <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle3" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{$post->like()->count()}}คน ถูกใจสิ่งนี้ 
            </div>
            <div class="modal-body" style="height: 300px; overflow-y:auto;">
                @foreach ($likeList as $like)
                    <a href="{{Route('userData',['id' => $like->user->user_id])}}"><p>{{$like->user->name}}</p></a>
                @endforeach
            </div>
        </div>
        </div>
    </div>
@endif