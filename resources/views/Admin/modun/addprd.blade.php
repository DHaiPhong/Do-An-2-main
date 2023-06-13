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
        <form method="post" action="{{route('admin.prd_add')}}" class="forms-sample">
            <div class="row">
                <div class="col">
                    @csrf
                    <div class="checkbox-card">
                        <label for="">New model</label>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="box" value="check" class="checkme">Yes
                            </label>
                        </div>
                        <div class="passport-box">
                            <input type="text" name="newprd" id="myText" placeholder="Enter Passport Number"
                                class="form-control">
                            
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Example multiple select</label>
                                <select class="form-control" id="example FormControlSelect2"  name="cat_id">
                                    <option value="1">Adidas</option>
                                    <option value="2">Nike</option>
                                    <option value="3">Puma</option>
                                    <option value="4">Yeezy</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="number" name="prd_price" class="form-control" id="exampleInputEmail1"
                                    value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">prd_sale</label>
                                <input type="number" name="prd_sale" class="form-control" id="" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">Detail</label>
                                <textarea type="text" name="prd_details" class="form-control" id="" value=""
                                    style="height: 10rem ;"> </textarea>
                            </div>

                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <input type="file" name="prd_image" onchange="preview();">
                                <img id="prd_image" width="auto" height="170px" src="/anh/noimg.jpg">


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
                        <label for="exampleInputEmail1">Color</label>
                        <input type="text" name="prd_color" class="form-control" id="exampleInputEmail1" value=" "
                            placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Amount</label>
                        <input type="number" name="prd_amount" class="form-control" id="exampleInputPassword1" value=""
                            placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Size</label>
                        <input type="number" name="prd_size" class="form-control" id="exampleInputPassword1" value="">
                    </div>


                    <button type="submit" href="" class="btn btn-light"
                        style="background-color: #c4f0c4; color: black">Edit</button>
                    <div class="">
                        <button type="submit" class="btn" href="">Next</button>
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
            document.getElementById("myText").value = ""
            document.getElementById("myText").value = ""
            document.getElementById("myText").value = ""
            document.getElementById("myText").value = ""
        } else {
            $(this).parents(".checkbox-card").find('.passport-box').hide();
            $(this).parents(".checkbox-card").find('.apply-box').show();
        }
    });
})
</script>
@stop