@extends('Admin.master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

@section('content')
    <div class="card" style="float: right; width: 72%; margin-right: 7%">
        <div class="card-body">
            <div style="box-sizing: border-box; margin-bottom: 1rem">
                <h4 class="card-title">Thêm Mã Giảm Giá</h4>
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
            <form method="post" action="{{ route('coupons.store') }}" class="forms-sample">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="slug-source">Code</label>
                            <input type="text" name="code" class="form-control" id="slug-source" value=""
                                placeholder="Nhập code Mã Giảm Giá" required onkeyup="generateSlug()">
                            @error('name')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug-target">Slug</label>
                            <input type="text" name="slug" class="form-control" required id="slug-target">
                        </div>
                        <div class="form-group">
                            <label for="">Số Lượng Giảm</label>
                            <input type="number" name="amount" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Ngày Hết Hạn</label>
                            <input type="date" name="expires_at" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Loại</label>
                            <select class="form-control" name="type" id="parent_id">
                                <option style="display:none" value="0">-- Chọn --</option>
                                <option value="fixed">Số</option>
                                <option value="percent">Phần Trăm</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" href="" class="btn btn-light"
                        style="background-color: #c4f0c4; color: black">Thêm</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ url('js/addprdjs/jquery-latest.min.js') }}"></script>
@endsection

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
    </script>
@endsection
