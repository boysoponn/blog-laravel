<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">อัพโหลด</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="upload" action="{{route('uploadSuccess')}}" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" name="file[]" id="file-upload" multiple="multiple">
                    <label class="custom-file-label" for="ile-upload">เลือกภาพของคุณ</label>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-secondary" type="submit">อัพโหลด</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
        </div>
    </div>
    </div>
</div>