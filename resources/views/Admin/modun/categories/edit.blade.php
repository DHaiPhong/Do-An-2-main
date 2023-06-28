@extends('Admin.master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

@section('content')
    <div class="card" style="float: right; width: 72%; margin-right: 7%">
        <div class="card-body">
            <div style="box-sizing: border-box; margin-bottom: 1rem">
                <h4 class="card-title">Edit Category</h4>
                <br>
            </div>
            <form method="post" action="{{ route('categories.update', $category->id) }}" class="forms-sample">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug-source">Name</label>
                            <input type="text" name="name" class="form-control" id="slug-source"
                                value="{{ $category->name }}" required placeholder="Enter Category Name"
                                onkeyup="generateSlug()">
                            @error('name')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Parent</label>
                            <select class="form-control" name="parent_id" id="parent_id">
                                <option value="">-- Sellect Category Parent --</option>
                                @foreach ($categories as $id => $name)
                                    @foreach ($categories as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ $id == $category->parent_id ? 'selected' : '' }}>{{ $name }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea type="text" name="description" class="form-control" id="" value="" style="height: 10rem ;">{{ $category->description }} </textarea>
                        </div>
                    </div>
                    <button type="submit" href="" class="btn btn-light"
                        style="background-color: #c4f0c4; color: black">Edit</button>
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
        function generateSlug() {
            var title = document.getElementById("slug-source").value;

            // Convert the title to lowercase and remove symbols and spaces
            var slug = title.toLowerCase().replace(/[^a-z0-9]+/g, '-');

            // Set the value of the slug input field to the generated slug
            document.getElementById("slug-target").value = slug;
        }
    </script>
@endsection
