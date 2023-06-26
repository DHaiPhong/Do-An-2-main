@extends('Admin.master')

@section('css')
<link href="{{ url('css/addprdcss/addprd.css') }}" rel="stylesheet" type="text/css">


@stop
@section('add')

<div class="card" style="float: right; width: 72%; margin-right: 7%">
    <div class="card-body">
        <div style="box-sizing: border-box;">
            <h4 class="card-title">Add Product</h4>
            <br>
        </div>
        @if(session('loi'))
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
        <form method="post" action="{{route('admin.prd_add')}}" class="forms-sample" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    @csrf
                    <div class="checkbox-card">
                        <!-- tên sản phẩm -->
                        <label for="">New model</label>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="box" value="check" class="checkme">Yes
                            </label>
                        </div>
                        <div class="passport-box">
                            <input type="text" name="newprd" id="myText" placeholder="Enter Name New Product"
                                class="form-control">
                        <!-- End tên sản phẩm     -->
                            <label for="toggleInput">New Brand</label>
                            <input type="checkbox" id="toggleInput" onclick="toggleTextInput()">
                            
                            <br>
                            <input class="form-control" type="text" id="textInput" name="newbrand" placeholder="Enter Name New Brand" style="display:none;">
                            <div id="cate" class="form-group">
                                <label for="exampleFormControlSelect2">Brands</label>
                                <select class="form-control" id="example FormControlSelect2" name="cat_id">
                                    @foreach($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->brand}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="number" name="prd_price" min="0" oninput="validity.valid||(value='');"
                                    class="form-control" id="exampleInputEmail1" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">Percent discount</label>
                                <input type="number" name="prd_sale" class="form-control" min="0" max="100"
                                    oninput="validity.valid||(value='');" id="" value="0" placeholder="%">
                            </div>


                            <div class="form-group">
                                <label>Ảnh sản phẩm </label>
                                <input type="file" class="" name="images[]" placeholder="anh" multiple>



                            </div>
                        </div>
                        <div class="apply-box">
                            <label for="exampleFormControlSelect2">Select</label>
                            <select class="form-control" id="example FormControlSelect2" name="prd_id">
                                @foreach($products as $product)
                                <option value="{{$product -> prd_id}}">{{$product->prd_name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>





                </div>
                <div class="col">


                    <div class="form-group">
                        <label for="exampleInputPassword1">Amount</label>
                        <input type="number" name="prd_amount" min="0" oninput="validity.valid||(value='');"
                            class="form-control" id="exampleInputPassword1" value="0" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Size</label>

                        <select class="form-control" id="example FormControlSelect2" name="prd_size">
                            <option value="38">38</option>
                            <option value="39">39</option>
                            <option value="40">40</option>
                            <option value="41">41</option>
                            <option value="42">42</option>
                            <option value="43">43</option>

                        </select>
                    </div>



                    <div class="">
                        <button type="submit" class="btn btn-light" style="background-color: #c4f0c4; color: black"
                            href="">Next</button>
                    </div>
                </div>


            </div>
    </div>
    </form>
</div>
</div>

<script src="{{url('js/addprdjs/jquery-latest.min.js')}}"></script>
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