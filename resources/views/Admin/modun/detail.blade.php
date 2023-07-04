@extends('Admin.master')

@section('content')

    <div class="card" style="float: right; width: 72%; margin-right: 7%">
        <div class="card-body">
            <h4 class="card-title">Chỉnh Sửa Người Dùng</h4>
            <br>
            <form method="post" action="{{ route('account.edit', ['id' => $user->id]) }}"class="forms-sample">
                @csrf
                <label for="exampleInputEmail1">Id: {{ $user->id }} </label>

                <div class="form-group">
                    <label for="exampleInputUsername1">Tên</label>
                    <input type="text" name="name" class="form-control" id="exampleInputUsername1"
                        value="{{ $user->name }}" placeholder="Nhập tên" required>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                        value="{{ $user->email }} " placeholder="email" required>
                </div>



                <div class="form-group">
                    <label for="">Số Điện Thoại</label>
                    <input type="text" name="phone" class="form-control" id="" value="{{ $user->phone }} "
                        placeholder="phone number" required>
                </div>

                <div class="form-group">
                    <label for="">Địa Chỉ</label>
                    <input type="text" name="address" class="form-control" id="" value="{{ $user->address }} "
                        placeholder="Address" required>
                </div>
                <div class="form-group">

                    @if (Auth::user()->id != $user->id)
                        <label for="exampleFormControlSelect2">Level</label>
                        <select class="form-control" id="example FormControlSelect2" name="level">
                            <option value="1" @if ($user->level == 1) selected @endif>Admin</option>
                            <option value="2" @if ($user->level != 1) selected @endif>Người Dùng</option>
                        </select>
                    @else
                        <input type="hidden" name="level" class="form-control" id=""
                            value="{{ $user->level }} ">
                    @endif
                </div>
                <button type="submit" href="{{ route('account.edit', ['id' => $user->id]) }}" class="btn btn-light"
                    style="background-color: #c4f0c4; color: black">Sửa</button>
                <a href="{{ route('account.delete', ['id' => $user->id]) }}" class="btn btn-light"
                    style="background-color: #f85766; color: black">Xóa</a>
            </form>
        </div>
    </div>
@stop
