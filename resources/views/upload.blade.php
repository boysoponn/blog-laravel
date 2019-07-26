@extends('layouts.app')

@section('content')
<form method="POST" id="upload" action="{{route('uploadSuccess')}}" enctype="multipart/form-data">
    @csrf
    <div class="input-group mb-3">
        <div class="custom-file">
        <input type="file" class="custom-file-input" name="file" id="file-upload">
        <label class="custom-file-label" for="ile-upload">เลือกภาพของคุณ</label>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-secondary" type="submit">อัพโหลด</button>
    </div>
</form>
@endsection


@section('script')

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\UploadForm','#upload')!!}
@endsection 