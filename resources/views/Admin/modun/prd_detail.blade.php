@extends('Admin.master')

@section('content')

    <div class="card" style="float: right; width: 72%; margin-right: 7%">
        <div class="card-body">
            <div style="box-sizing: border-box;">
                <h4 class="card-title">Edit Product</h4>
                <br>
            </div>
            <form method="post" action="{{ route('admin.prd_edit', ['id' => $product->prd_detail_id]) }}" class="forms-sample">
                <div class="row">
                    <div class="col">
                        @csrf
                        <label for="exampleInputEmail1">Id: {{ $product->prd_detail_id }} </label>

                        <div class="form-group">
                            <label for="exampleInputUsername1">Product name</label>
                            <input type="text" name="prd_name" class="form-control" id="exampleInputUsername1"
                                value="{{ $product->prd_name }}" placeholder="name">


                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Example multiple select</label>
                            <select class="form-control" id="example FormControlSelect2" name="cat_id">
                                <option value="1" @if ($product->cat_id == 1) selected @endif>Adidas</option>
                                <option value="2" @if ($product->cat_id == 2) selected @endif>Nike</option>
                                <option value="3" @if ($product->cat_id == 3) selected @endif>Puma</option>
                                <option value="4" @if ($product->cat_id == 4) selected @endif>Yeezy</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Color</label>
                            <input type="text" name="prd_color" class="form-control" id="exampleInputEmail1"
                                value="{{ $product->prd_color }} " placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <input type="number" name="prd_price" class="form-control" id="exampleInputEmail1"
                                value="{{ $product->price }}" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Amount</label>
                            <input type="number" name="prd_amount" class="form-control" id="exampleInputPassword1"
                                value="{{ $product->prd_amount }}" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Size</label>
                            <input type="number" name="prd_size" class="form-control" id="exampleInputPassword1"
                                value="{{ $product->prd_size }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Detail</label>
                            <textarea type="text" name="prd_details" class="form-control" id="" value="" style="height: 10rem ;">{{ $product->prd_details }} </textarea>
                        </div>

                        <div class="form-group">
                            <label>Ảnh sản phẩm</label>
                            <input type="file" name="prd_image" onchange="preview();">
                            <img id="prd_image" width="auto" height="170px" src="/anh/{{ $product->prd_image }}">


                        </div>
                        <div class="form-group">
                            <label for="">prd_sale</label>
                            <input type="number" name="prd_sale" class="form-control" id=""
                                value="{{ $product->prd_sale }}" placeholder="">
                        </div>
                        <button type="submit" href="" class="btn btn-light"
                            style="background-color: #c4f0c4; color: black">Edit</button>
                        <a href="" class="btn btn-light" style="background-color: #f85766; color: black">Delete</a>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function preview() {
            prd_image.src = URL.createObjectURL(event.target.files[0]);


        }
    </script>
@stop
