@extends('layouts.app')

@if (isset($post) && !empty($post))
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">หน้าแรก</a></li>
            @if (isset($post->category->category_id) && !empty($post->category->category_id) && isset($post->category->name) && !empty($post->category->name))
                <li class="breadcrumb-item"><a href="{{route('category',['id' => $post->category->category_id])}}">{{$post->category->name}}</a></li>
            @else
                <li class="breadcrumb-item active" aria-current="page">ไม่ระบุประเภท</li>
            @endif
            @if (isset($post->title) && !empty($post->title))
                <li class="breadcrumb-item active" aria-current="page">{{$post->getLimit($post->title,10)}}</li>
            @endif
        </ol>
    </nav>
    @include('component.post',['post' => $post])
    <div class="modal fade" id="exampleModalCenter3"   tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle3" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <hr>
    @if (Auth::guard('web')->check())
        <form method="POST" id="commentForm" action="{{route('commentSuccess',['id' => $post->post_id])}}">
            @csrf
            <div class="form-group">
                <label for="comment">ความคิดเห็น</label>
                <textarea class="form-control" name="content" id="comment" rows="3"></textarea>
            </div>
            <p id='nameFileUpload'></p>
            <button type="button" id="imageListBtn" class="btn btn-primary" data-toggle="modal" data-target="#modalImageList">แนบรูปภาพ</button>
            @include('component.imageList')
            <div class="form-group">
                <button class="btn btn-secondary" type="submit">ยืนยัน</button>
            </div>
        </form>
        @include('component.upload')
    @endif
    <hr>
    @foreach ($commentList as $comment)
        @include('component.comment',['comment' => $comment])
    @endforeach
    {{ $commentList->links() }}
@endsection
@else
    @section('content')
        <h2>ไม่พบกระทู้ดังกล่าว</h2> 
        <a href="{{route('home')}}"><button type="button"  class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
    @endsection  
@endif

@section('script')
<script>
    $(document).on('click', ".likePost.fas", function(e){
        var likePostBtn = $(this);
        $.ajax({
           type:'get',
           url:"{{ route('unlikePostSuccess',$post->post_id) }}",
           success:function(data){
            likePostBtn.removeClass("fas").addClass("far");
            if(data.msg === 0){
                $("#textLikePost").text('เป็นคนแรกที่ถูกใจสิ่งนี้');
            }else{
                $("#textLikePost").text(data.msg);
            }
           }
        });
	});

    $(document).on('click',".likePost.far", function(e){
        var likePostBtn = $(this);
        $.ajax({
           type:'get',
           url:"{{ route('likePostSuccess',$post->post_id) }}",
           success:function(data){
            $("#textLikePost").text(data.msg);
            likePostBtn.removeClass("far").addClass("fas");
           }
        });
    });

    $(document).on('click', ".likeComment.fas", function(e){
        var comment_id = $(this).data('comment');
        var likeCommentBtn = $(this);
  
        $.ajax({
           type:'get',
           url:"{{route('unlikeCommentSuccess',['id'=> ':id'])}}".replace(':id',comment_id),
           success:function(data){
            likeCommentBtn.removeClass("fas").addClass("far");
            if(data.msg === 0){
                $("#textLikeComment"+comment_id).text('เป็นคนแรกที่ถูกใจสิ่งนี้');
            }else{
                $("#textLikeComment"+comment_id).text(data.msg);
            }
           }
        });
	});

    $(document).on('click', ".likeComment.far", function(e){
        var comment_id = $(this).data('comment');
        var likeCommentBtn = $(this);

        $.ajax({
           type:'get',
           url:"{{route('likeCommentSuccess',['id'=> ':id'])}}".replace(':id',comment_id),
           success:function(data){
            $("#textLikeComment"+comment_id).text(data.msg);
            likeCommentBtn.removeClass("far").addClass("fas");
           }
        });
    });

    $(document).on('click', '#textLikePost', function(){
        $($(this).data("target")+' .modal-content').load("{{route('modelLikePost',$post->post_id)}}");
    });

    $(document).on('click', '.textComment', function(){
        var comment_id = $(this).data('comment');
        $($(this).data("target")+' .modal-content').load("{{route('modelLikeComment',['id'=> ':id'])}}".replace(':id',comment_id));
    });
    
    $(document).on('click', '#imageListBtn', function(){
        $($(this).data("target")+' .modal-body').load("{{route('modelImageList')}}");
    });

    $(document).on('click','.unChooseImage',function(){
        var id = $(this).data("imageid");
        $(this).removeClass("unChooseImage").addClass("ChooseImage");
        $('#inputImgae'+id).attr("checked",true) 
    });

    $(document).on('click','.ChooseImage',function(){
        var id = $(this).data("imageid");
        $(this).removeClass("ChooseImage").addClass("unChooseImage");
        $('#inputImgae'+id).attr("checked",false) ;  
    });
    
    //upload

    $("#uploadForm").submit(function(event){
    event.preventDefault();
    var post_url = $(this).attr("action");
    var request_method = $(this).attr("method");
	var form_data = new FormData(this);
    $.ajax({
        url : post_url,
        type: request_method,
        data : form_data,
		contentType: false,
		processData:false,
        success:function(data){
            $('#exampleModalCenter2').modal('toggle')
            $('#modalImageList'+' .modal-body').load("{{route('modelImageList')}}");
        }
    })
});
</script>


<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

{!! JsValidator::formRequest('App\Http\Requests\CommentForm','#commentForm')!!}
{!! JsValidator::formRequest('App\Http\Requests\UploadForm','#uploadForm')!!}
@endsection 