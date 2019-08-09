
    @if($imageList->isNotEmpty())
        <div class="row text-center text-lg-left">
                @foreach ($imageList as $image)
                    @php
                        $checked = false;
                        // if (isset($imageUpload)){
                        //     if ($imageUpload->keys()->contains($image->upload_id)) {
                        //         $checked = true;
                        //     }
                        // }
                    @endphp
                    <div style="display:flex; align-items:center;" class="col-lg-3 col-md-4 col-6">
                        <input style="display:none;" type="checkbox" id="{{'inputImgae'.$image->upload_id}}" name='file[]' @if ($checked) checked @endif aria-label="Checkbox for following text input" value="{{$image->upload_id}}">
                        <img  class="unChooseImage img-thumbnail" data-imageid="{{$image->upload_id}}" id="{{'image'.$image->upload_id}}" src="{{asset('uploads/'.Auth::user()->user_id.'/'.$image->name)}}" alt="">
                    </div> 
                @endforeach                    
            </div>
        </div>
    @else
        ยังไม่รูปภาพใดๆ
    @endif