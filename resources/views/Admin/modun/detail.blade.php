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
                    <input type="text" name="phone" class="form-control" id="phone_number" value="{{ $user->phone }} "
                        placeholder="phone number" required>
                </div>

                <div class="form-group">
                    <label for="">Địa Chỉ</label>
                    <input type="text" name="address" class="form-control" id="" value="{{ $user->address }} "
                        placeholder="Address" required>
                </div>
                <div class="form-group">
                    @if(Auth::user()->role == 'admin')
                        @if (Auth::user()->id != $user->id)
                            <label for="exampleFormControlSelect2">Level</label>
                            <select class="form-control" id="example FormControlSelect2" name="role">
                                <option value="0" @if ($user->role == 2) selected @endif>Admin</option>
                                <option value="1" @if ($user->role == 1) selected @endif>Editor</option>
                                <option value="0" @if ($user->role == 0) selected @endif>Người Dùng</option>
                                
                            </select>
                        @else
                            <input type="hidden" name="role" class="form-control" id=""
                                value="{{ $user->role }} ">
                        @endif
                    @else
                    <input type="hidden" name="role" value="{{ $user->role }}">
                    @endif
                </div>
                <button type="submit" href="{{ route('account.edit', ['id' => $user->id]) }}" class="btn btn-light"
                    style="background-color: #c4f0c4; color: black">Sửa</button>
                <a href="{{ route('account.delete', ['id' => $user->id]) }}" class="btn btn-light"
                    style="background-color: #f85766; color: black">Xóa</a>
            </form>
        </div>
    </div>
    <script>
        var input = document.getElementById('phone_number');
        input.addEventListener('input', function() {
            if (this.value.includes("+")) {
                this.value = this.value.replace(/[^0-9+]/, '');
                if (this.value.length > 12) {
                    this.value = this.value.slice(0, 12);
                }
            } else {
                this.value = this.value.replace(/[^0-9]/, '');
                if (this.value.length > 10) {
                    this.value = this.value.slice(0, 10);
                }
            }
        });
    </script>
@stop
