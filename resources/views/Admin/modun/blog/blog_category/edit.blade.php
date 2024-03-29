@extends('Admin.master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

@section('content')
    <div class="card" style="float: right; width: 72%; margin-right: 7%">
        <div class="card-body">
            <div style="box-sizing: border-box; margin-bottom: 1rem">
                <h4 class="card-title">Edit Blog Category</h4>
                <br>
            </div>
            <form method="post" action="{{ route('admin.blog.category.update', $blog_category->id) }}" class="forms-sample"
                enctype="multipart/form-data">
                <div class="row">
                    @csrf
                    @method('PUT')

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug-source">Title</label>
                            <input type="text" name="title" class="form-control" id="slug-source"
                                value="{{ old('title') ?? $blog_category->title }}" placeholder="Enter Title"
                                onkeyup="generateSlug()">
                            @error('title')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea type="text" name="description" class="form-control" id="" style="height: 10rem ;">{{ old('description') ?? $blog_category->description }} </textarea>
                            @error('description')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug-target">Slug</label>
                            <input type="text" name="slug" value="{{ old('slug') ?? $blog_category->slug }}"
                                class="form-control" id="slug-target">
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @if ($blog_category->image)
                                <img src="{{ asset('storage/images/' . $blog_category->image) }}"
                                    alt="{{ $blog_category->title }}" width="auto" height="170px">
                            @endif
                        </div>
                    </div>
                    <div class="form-check" style="margin-left: 1rem">
                        <input class="form-check-input" type="radio" checked name="status" value="1"
                            id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Active
                        </label>
                    </div>
                    <div class="form-check" style="margin-left: 1rem">
                        <input class="form-check-input" type="radio" name="status" value="0" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Inactive
                        </label>
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
