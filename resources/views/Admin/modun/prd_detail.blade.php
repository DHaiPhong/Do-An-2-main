@extends('Admin.master')

@section('content')


    <div class="card" style="float: right; width: 72%; margin-right: 7%">
        <div class="card-body">
            <div style="box-sizing: border-box;">
            
                <h4 class="card-title"> <a  href="{{ route('admin.product') }}"><img src="/anh/arrow.png" style="width:15px ;margin-right:15px;"></a>Sửa Sản Phẩm</h4>

                <br>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('admin.prd_edit', ['id' => $product->prd_id]) }}"
                enctype="multipart/form-data" class="forms-sample">
                <div class="row">
                    <div class="col">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Tên</label>
                            <input type="hidden" name="prd_detail_id" value="{{ $product->prd_detail_id }}">
                            <input type="text" name="prd_name" class="form-control" id="exampleInputUsername1"
                                value="{{ $product->prd_name }}" placeholder="name">
                            

                        </div>
                        <div id="cate" class="form-group">
                            <label for="exampleFormControlSelect2">Danh Mục</label>
                            <select name="category_id" id="category" class="form-control">
                                @foreach ($cate as $key => $cat)
                                    <option value="{{ $cat->id }}" @if ($product->category_id == $cat->id) selected @endif>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá</label>
                            <input type="number" name="prd_price" class="form-control" id="exampleInputEmail1"
                                value="{{ $product->price }}"  placeholder="">
                        </div>
                        
                    </div>
                    <div class="col">
                        
                            <input type="hidden" name="prd_details" class="form-control" id="" value="" style="height: 10rem ;">{{ $product->prd_details }} </input>

                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Size : {{ $product->prd_size }}</label><br>
                            <label for="exampleInputPassword1">Số Lượng (Theo size)</label>
                            <input type="number" name="prd_amount" class="form-control" id="exampleInputPassword1"
                                value="{{ $product->prd_amount }}" min="0" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="">Giảm(%)</label>
                            <input type="number" name="prd_sale" class="form-control" id=""
                                value="{{ $product->prd_sale }}" placeholder="">
                        </div>
                        

                    </div>
                </div>


                <div class="width: 1000px">
                    <label>Thêm ảnh sản phẩm (Ảnh làm Bìa chọn cuối)</label>

                    <input type="file" class="" name="images[]" placeholder="anh" multiple>

                    <div class="d-flex flex-wrap"
                        style="display: flex;width: 100%;flex-wrap: wrap; justify-content: space-around;">


                        @foreach ($images as $key => $image)
                            <div
                                style="display: flex;flex-basis: 20%; padding: 30px; padding-bottom:10px;margin:10px; flex-direction: column; border: 1px solid #00000026; border-radius: 10px;">
                                <img id="prd_image" width="100%" height="auto" src="/anh/{{ $image->prd_image }}">

                                <a style="text-align: center; color:red;" onclick="myalert({{ $image->id }}) "
                                    type="button"> Xóa</a>

                            </div>
                        @endforeach


                    </div>
                </div>
                <button type="submit" href="" class="btn btn-light"
                    style="background-color: #c4f0c4; color: black">Sửa</button>
                <a class="btn btn-primary" style=" color: black" onclick="myalert2({{ $product->prd_detail_id }})">Xóa
                    Size</a>

            </form>

            <button class="btn btn-primary" onclick="myalert3({{ $product->prd_id }})"
                style="background-color: #f85766;">Xóa Sản Phẩm</button>
        </div>
    </div>

@stop

@section('js')
    <script>
        function myalert(id) {

            if (confirm('Bạn có chắc muốn xóa hình ảnh này không?')) {
                console.log('Yes');
                const x = id;

                window.location.href = "http://127.0.0.1:8000/admin/product/removeImage/" + x;
            } else {


                console.log('No');
            }
        }

        function myalert2(id) {
            if (confirm('Bạn có chắc muốn xóa Size này không?')) {
                console.log('Yes');
                const x = id;

                window.location.href = "http://127.0.0.1:8000/admin/product/deleteSize/" + x;
            } else {


                console.log('No');
            }

        }

        function myalert3(id) {
            if (confirm('Bạn có chắc muốn xóa sản phẩm này không?')) {
                console.log('Yes');
                const x = id;

                window.location.href = "http://127.0.0.1:8000/admin/product/delete/" + x;
            } else {
                console.log('No');
            }

        }

        function toggleTextInput() {
            var checkBox = document.getElementById("toggleInput");
            var textInput = document.getElementById("textInput");
            var cate = document.getElementById("cate");

            if (checkBox.checked) {
                textInput.style.display = "block";
                cate.style.display = "none";
            } else {
                document.getElementById("textInput").value = ""
                textInput.style.display = "none";
                cate.style.display = "block";
            }
        }
    </script>
@endsection
