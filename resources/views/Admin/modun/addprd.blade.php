@extends('Admin.master')

@section('css')
    <link href="{{ url('css/addprdcss/addprd.css') }}" rel="stylesheet" type="text/css">


@stop

@section('content')
    <div class="card" style="float: right; width: 72%; margin-right: 7%">
        <div class="card-body">
            @if (session('loi'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ session('loi') }}</li>
                    </ul>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div style="box-sizing: border-box;">
                <h4 class="card-title">Thêm Sản Phẩm</h4>
                <br>
            </div>
            <form method="post" action="{{ route('admin.prd_add') }}" class="forms-sample" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        @csrf
                        <div class="checkbox-card">
                            <label for="">Sản Phẩm Mới</label>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="uncheck" class="checkme">Thêm
                                    <input type="hidden" name="box" value="uncheck" class="hiden" >
                                </label>
                            </div>
                            <div class="passport-box">
                                <div class="form-group">
                                    <label for="slug-source">Tên</label>
                                    <input type="text" name="newprd" class="form-control" id="slug-source"
                                        value="" placeholder="Nhập tên Danh Mục"  onkeyup="generateSlug()">
                                    @error('newprd')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug-target">Slug</label>
                                    <input type="text" name="slug"  class="form-control" id="slug-target">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Chọn Danh Mục</label>
                                    <select name="category_id" id="category" class="form-control">
                                        <option style="display:none" value="0">Chọn</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="number" name="prd_price" class="form-control" max="10000000" min="0" id="exampleInputEmail1"
                                        value="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Giảm (%)</label>
                                    <input type="number" name="prd_sale" class="form-control" id="" max="100" min="0" value="0"
                                        placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Chi Tiết</label>
                                    <textarea type="text" name="prd_details" class="form-control" id="" value="" style="height: 10rem ;"> </textarea>
                                </div>


                                <div class="form-group">
                                    <label>Ảnh sản phẩm </label>
                                    <input type="file" class="" name="images[]" placeholder="anh" multiple>



                                </div>
                            </div>
                            <div class="apply-box">
                                <label for="exampleFormControlSelect2">Thêm Size cho sản phẩm</label>
                                <select class="product" id="example FormControlSelect2" name="prd_id">
                                    <option value="0" hidden >chọn </option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->prd_id }}" data-size="{{$product->new_size}}"data-image-url="{{ $product->prd_image }}">{{ $product->prd_name }}</option>
                                    @endforeach
                                </select>
                                <img style="width:200px;padding-top:20px" id="productImage" src="/anh/noimg.jpg" alt="Product Image">
                                <p> Size hiện tại của sản phẩm: <span class="nbsize"></span></p>
                                


                            </div>
                        </div>

                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số Lượng</label>
                            <input type="number" name="prd_amount" min="0" oninput="validity.valid||(value='');"
                                class="form-control" id="exampleInputPassword1" value="0" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Size</label>

                            <select class="sosize" id="example FormControlSelect2" name="prd_size">
                                <option hidden value="0">chọn</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option disabled value="42">42</option>
                                <option value="43">43</option>
                            </select>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-light" style="background-color: #c4f0c4; color: black"
                                href="">Thêm</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="{{ url('js/addprdjs/jquery-latest.min.js') }}"></script>
    <script>
        $(function() {
            $(".checkme").click(function(event) {
                var x = $(this).is(':checked');
                if (x == true) {
                    $(this).parents(".checkbox-card").find('.passport-box').show();
                    $(this).parents(".checkbox-card").find('.apply-box').hide();
                    document.getElementById("myText").value = ""

                } else {
                    $(this).parents(".checkbox-card").find('.passport-box').hide();
                    $(this).parents(".checkbox-card").find('.apply-box').show();
                }
            });
        })

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
@stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        function removeAccents(str) {
            return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        }

        function generateSlug() {
            var title = document.getElementById("slug-source").value;
            title = removeAccents(title); // Remove accents

            // Convert the title to lowercase and remove symbols and spaces
            var slug = title.toLowerCase().replace(/[^a-z0-9]+/g, '-');

            // Set the value of the slug input field to the generated slug
            document.getElementById("slug-target").value = slug;
        }

        document.getElementById('example FormControlSelect2').addEventListener('change', function() {
    var selectedIndex = this.selectedIndex;
    var selectedProduct = this.options[selectedIndex];
    var imageUrl = "/anh/" + selectedProduct.getAttribute('data-image-url');
    
    document.getElementById('productImage').src = imageUrl;
});

const checkbox = document.querySelector('.checkme');
const hiden = document.querySelector('.hiden');

checkbox.addEventListener('change', function() {
  if (this.checked) {
    hiden.value = 'check';
  } else {
    hiden.value = 'uncheck';
  }
});
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
 <script>

$(document).ready(function() {
    $('.product').change(function() {
        var sizeData = $('option:selected', this).attr('data-size');
        var sizes = sizeData.split(',');
        
        $('.nbsize').text(sizes) 
        
        $('.sosize option').each(function() {
            $(this).show();
        });
        for (var i = 38; i < 44; i++) {
            $('.sosize option[value="' + i + '"]').prop('disabled', false);
            $('.sosize option[value="' + i + '"]').css('background', 'white');
            $('.sosize option:eq(0)').prop('selected', true);
        }
        for (var i = 0; i < sizes.length; i++) {
            $('.sosize option[value="' + sizes[i] + '"]').prop('disabled', true);
            $('.sosize option[value="' + sizes[i] + '"]').css('background', '#d5d5d5');

        }
    });
});



</script>

@endsection
