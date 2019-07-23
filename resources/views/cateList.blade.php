@extends('layouts.app')

    @section('content')
        @if($cateList->isNotEmpty())
            @foreach ($cateList as $cate)
                <div class="alert alert-primary" role="alert">
                    <div class="container">
                        <div class="row">
                            <div class="col-9">
                                    {{$cate->name}}
                            </div>
                            <div class="col-1">
                                <a href="{{Route('cateEdit',['id' => $cate->category_id])}}"><button type="button" @if($cate->deleted_at) disabled @endif class="btn btn-primary">แก้ไข</button></a>
                            </div>
                            @if($cate->deleted_at)
                                <div class="col-1">
                                    <a href="{{Route('cateShow',['id' => $cate->category_id])}}"><button type="button"  class="btn btn-secondary">แสดง</button></a>
                                </div>
                            @else
                                <div class="col-1">
                                    <a href="{{Route('cateHidden',['id' => $cate->category_id])}}"><button type="button"  class="btn btn-secondary">ซ่อน</button></a>
                                </div>
                            @endif
                            <div class="col-1">
                                <a href="{{Route('cateDelete',['id' => $cate->category_id])}}"><button type="button"  class="btn btn-danger">ลบ</button></a>
                            </div>
                        </div>
                    </div>    
                </div>
            @endforeach
        @endif

        <form method="POST" id="cateAdd" action="{{route('cateAdd')}}">
            @csrf
            <div class="form-group">
                <label for="cate">เพิ่มประเภท</label>
                <input type="text" class="form-control" name="name" id="cate" >
            </div>
            <div class="form-group">
                    <label for="description">คำอธิบาย</label>
                    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                </div>
            <div class="form-group">
                <button type="submit">ยืนยัน</button>
            </div>
        </form>
    @endsection

    @section('script')
    <!-- Javascript Requirements -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\CateForm','#cateAdd')!!}
    @endsection 