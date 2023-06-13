@extends('Admin.master')
@section('add')
<section style="margin-left:400px">
<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{route('storeimg')}}">
    @csrf
    <div class="form-group">
        <label>Ảnh sản phẩm</label>
        <!-- <input type="file" name="prd_image" onchange="preview();"> -->
        <input required type="file" class="form-control" name="images[]" placeholder="anh" multiple>
        <img id="prd_image" width="auto" height="170px" src="/anh/noimg.jpg">
        <button class="btn-light" type="submit">them </button>

    </div>

</form>
</section>
    @stop