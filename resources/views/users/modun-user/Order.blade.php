@extends('users.masterUser')
@section('css')

<style>
th {
    text-align: center;


}

td {
    vertical-align: middle;
    text-align: center;
}

.profile-page .profile {
    text-align: center;
}

.profile-page .profile img {
    max-width: 160px;
    width: 100%;
    margin: 0 auto;
    -webkit-transform: translate3d(0, -50%, 0);
    -moz-transform: translate3d(0, -50%, 0);
    -o-transform: translate3d(0, -50%, 0);
    -ms-transform: translate3d(0, -50%, 0);
    transform: translate3d(0, -50%, 0);
}

.img-raised {
    box-shadow: 0 5px 15px -8px rgba(0, 0, 0, .24), 0 8px 10px -5px rgba(0, 0, 0, .2);
}

.rounded-circle {
    border-radius: 50% !important;
}

.img-fluid,
.img-thumbnail {
    max-width: 100%;
    height: auto;
}

.main {
    background: #FFF;
    position: relative;
    z-index: 3;
}

.main-raised {
    margin: 30px 0;
    border-radius: 6px;
    box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2);
}


.profile-page .description {
    margin: 1.071rem auto 0;
    max-width: 600px;
    color: #999;
    font-weight: 300;
}

.header-filter:after,
.header-filter:before {
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 100%;
    display: block;
    left: 0;
    top: 0;
    content: "";
}

.fixed-top {
    position: fixed;
    z-index: 1030;
    left: 0;
    right: 0;
}

.profile-page .page-header {
    height: 380px;
    background-position: center;
}

#popup {
    display: none;
    position: fixed;
    z-index: 999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    font-size: 15px;
}

#popupContent {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    width: 600px;
}

#editButton {
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#editButton:hover {
    background-color: #45a049;
}
</style>


@stop

@section('content')

<div style="margin-bottom: 180px;">
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="main main-raised">
                        <div class="profile-content" style="">
                            <div class="container" style="padding-bottom:20px;margin-top:20px ;">

                                <div class="avatar" style="margin-left: 30%;margin-right: 30%">
                                    <img src="https://t4.ftcdn.net/jpg/03/59/58/91/360_F_359589186_JDLl8dIWoBNf1iqEkHxhUeeOulx0wOC5.jpg"
                                        alt="Circle Image" class="img-raised rounded-circle img-fluid"
                                        style="width:150px">
                                </div>

                                <div class="name" style="text-align: center; margin-top: 20px ;">
                                    <p style="text-align: center; font-size:1.8rem;">{{ Auth::user()->name }}</p>
                                </div>
                                <div style="font-size:2rem; margin-top:20px ; ">
                                    <div>
                                        <span style="text-transform: none;">
                                            Address: {{ Auth::user()->address }}
                                        </span>

                                    </div>
                                    <div style="margin-top:10px">
                                        <span style="text-transform: none;">Phone: {{ Auth::user()->phone }}</span>

                                    </div>
                                    <div style="margin-top:10px">
                                        <span style="text-transform: none;">
                                            Email: {{ Auth::user()->email }}
                                        </span>



                                    </div>

                                    <button id="editButton">Chỉnh sửa</button>

                                    <div id="popup">
                                        <div id="popupContent">
                                            <h2>Chỉnh sửa thông tin người dùng</h2>

                                            <form id="editForm" method="post" action="{{ route('users.updateacc') }}">
                                                @csrf
                                                <div style="display:flex; flex-wrap:nowrap;">
                                                    <div class="left-form" style="flex:20%">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text"
                                                                style="width:100%;text-align:center;font-size:16px;"
                                                                id="basic-addon1">Tên người dùng</span>

                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text"
                                                                style="width:100%;text-align:center;font-size:16px;"
                                                                id="basic-addon1">Email</span>

                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text"
                                                                style="width:100%;text-align:center;font-size:16px;"
                                                                id="basic-addon1">Số điện thoại</span>

                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text"
                                                                style="width:100%;text-align:center;font-size:16px;"
                                                                id="basic-addon1">Mật khẩu</span>

                                                        </div>
                                                        <div class="input-group">
                                                            <span class="input-group-text"
                                                                style="width:100%;text-align:center;font-size:16px;">Địa
                                                                chỉ</span>

                                                        </div>
                                                    </div>
                                                    <div class="right-form" style="flex:80%;">
                                                        <div class="input-group mb-3">

                                                            <input type="text" class="form-control"
                                                                style="font-size:16px;" value="{{ Auth::user()->name }}"
                                                                name="name" aria-label="Username"
                                                                aria-describedby="basic-addon1" />
                                                        </div>
                                                        <div class="input-group mb-3">

                                                            <input type="text" class="form-control"
                                                                style="font-size:16px;"
                                                                value="{{ Auth::user()->email }}" name="email"
                                                                aria-label="Username" aria-describedby="basic-addon1" />

                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control"
                                                                style="font-size:16px;" id="phone_number"
                                                                value="{{ Auth::user()->phone }}" name="phone"
                                                                aria-label="Username" aria-describedby="basic-addon1" />

                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input type="password" class="form-control"
                                                                style="font-size:16px;" value="" name="password"
                                                                aria-label="Username" aria-describedby="basic-addon1" />


                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control"
                                                                style="font-size:16px;"
                                                                value="{{ Auth::user()->address }}" name="address"
                                                                aria-label="Username" aria-describedby="basic-addon1" />

                                                        </div>

                                                    </div>
                                                </div>
                                                <div
                                                    style="display:flex; flex-wrap:nowrap;justify-content: space-between;">
                                                    <button id="backbtn" type="button" class="btn btn-primary"> quay lại
                                                    </button>
                                                    <button type="submit" class="btn btn-primary"> Save </button>
                                                </div>
                                            </form>

                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-8" style="margin-top:30px;">
                    <div class="h-100 gradient-custom">

                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-lg-10" style="width:100%">
                                <div class="card" style="border-radius: 10px;">

                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <p class="lead fw-normal mb-0" style="color: #a8729a;font-size:20px">Đơn
                                                hàng</p>

                                            @if (session('success'))
                                            <div class="alert alert-success text-center m-0"
                                                style="font-size: 2rem; margin-bottom: 1rem;padding-left: 25px;padding-right: 25px;"
                                                role="alert">
                                                {{ session('success') }}
                                            </div>
                                            @endif
                                            @if (session('error'))
                                            <div class="alert alert-danger text-center m-0"
                                                style="font-size: 2rem; margin-bottom: 1rem;padding-left: 25px;padding-right: 25px;"
                                                role="alert">
                                                {{ session('error') }}
                                            </div>
                                            @endif



                                        </div>
                                    </div>
                                    <div class="card shadow-0 border mb-4">
                                        <div class="card-body" style="padding:3px;">
                                            <div class="row" style="font-size:15px">
                                                
                                                <div
                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0" style="font-size:15px">Mã đơn hàng</p>
                                                </div>
                                                <div
                                                    class="col-md-1 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0" style="font-size:15px">Người đặt</p>
                                                </div>
                                                <div
                                                    class="col-md-4 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">Địa chỉ</p>
                                                </div>
                                                <div
                                                    class="col-md-1 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">Tổng số lượng</p>
                                                </div>
                                                <div
                                                    class="col-md-1 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">
                                                        Tổng tiền</p>
                                                </div>
                                                <div
                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">Ngày đặt hàng</p>
                                                </div>
                                                <div
                                                    class="col-md-1 text-center d-flex justify-content-center align-items-center">
                                                    
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                    @foreach ($orders as $key => $item)
                                    <div class="card shadow-0 border mb-4">
                                        <div class="card-body" style="padding:3px;border-top:2px solid #57555585;">
                                            <div class="row" style="font-size:15px">
                                                
                                                <div
                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0" style="font-size:15px">{{ $item->order_number }}</p>
                                                </div>
                                                <div
                                                    class="col-md-1 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0" style="font-size:15px">{{ $item->name }}</p>
                                                </div>
                                                <div
                                                    class="col-md-4 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">{{ $item->address }}</p>
                                                </div>
                                                <div
                                                    class="col-md-1 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">{{ $item->item_count }}</p>
                                                </div>
                                                <div
                                                    class="col-md-1 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">
                                                        {{ number_format($item->grand_total) }} đ</p>
                                                </div>
                                                <div
                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0 small">{{ $item->created_at }}</p>
                                                </div>
                                                <div
                                                    class="col-md-1 text-center d-flex justify-content-center align-items-center">
                                                    <a href="{{ route('users.orderdetail', ['id' => $item->order_id]) }}">
                                                          Chi tiết </a>
                                                </div>
                                                <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                                <div class="row d-flex align-items-center justify-content-between">
                                                    <div class="col-md-1 mr-auto">
                                                        <p class="text-muted mb-0 small">Tiến trình</p>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="progress" style="height: 6px; border-radius: 16px;width:80%">
                                                          @if($item->status == 'cancel')
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 100%; border-radius: 16px; background-color: red;"
                                                                aria-valuenow="0" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                            </div>
                                                          @elseif($item->status == 'pending')  
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 25%; border-radius: 16px; background-color: #a8729a;"
                                                                aria-valuenow="25" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                            </div>
                                                          @elseif($item->status == 'processing')  
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 50%; border-radius: 16px; background-color: blue;"
                                                                aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                            </div>
                                                          @elseif($item->status == 'shipping')  
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 75%; border-radius: 16px; background-color: yellow;"
                                                                aria-valuenow="75" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                            </div>
                                                          @elseif($item->status == 'completed')  
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 100%; border-radius: 16px; background-color: green;"
                                                                aria-valuenow="75" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                            </div>
                                                          @endif
                                                          
                                                        </div>
                                                        <div class="d-flex mb-1 justify-content-end">
                                                          @if($item->status == 'cancel')
                                                        
                                                            <p class="text-muted mt-1 mb-0 small ms-xl-5 p-2" style="font-size:15px">Đơn hàng đã bị hủy</p>
                                                          @elseif($item->status == 'pending')
                                                          <a class="btn btn-danger btn-fw p-2"
                                                                        style="  background-color: #ff375f; border-color: #ff375f; float: right; margin-top: 2px;width: 90px;padding: 0;margin-right: 50px;"
                                                                        href="{{ route('users.ordercancel', $item->order_id) }}"
                                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa đơn đặt hàng này?')">Hủy</a>
                                                            <p class="text-muted mt-1 mb-0 small ms-xl-5 p-2" style="font-size:15px;fload:right">{{$item->status}}</p>
                                                          @else
                                                           <p class="text-muted mt-1 mb-0 small ms-xl-5 p-2" style="font-size:15px;fload:right">{{$item->status}}</p>
                                                          @endif
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{ $orders->links() }}


                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<script>
document.getElementById("backbtn").addEventListener("click", function() {
    document.getElementById("popup").style.display = "none";

})
document.getElementById("editButton").addEventListener("click", function() {
    document.getElementById("popup").style.display = "flex";
});
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
@endsection