<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">รูปภาพ</h5>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter2" >อัพโหลด</button>
        </div>
        <div class="modal-body" style="height: 450px; overflow-y:auto;">
            @foreach ($imageList as $image)
                    @php
                        $checked = false;
                        if (isset($imageUpload)){
                            if ($imageUpload->keys()->contains($image->upload_id)) {
                                $checked = true;
                            }
                        }
                    @endphp      
                <input type="checkbox" id={{$image->upload_id}} name='file[]' @if ($checked) checked @endif aria-label="Checkbox for following text input" value="{{$image->upload_id}}"> 
                <img width="29%" class="img-thumbnail" id={{$image->upload_id}} src="{{asset('uploads/'.Auth::user()->user_id.'/'.$image->name)}}" alt="">
            @endforeach
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ตกลง</button>
        </div>
    </div>
    </div>
</div>
