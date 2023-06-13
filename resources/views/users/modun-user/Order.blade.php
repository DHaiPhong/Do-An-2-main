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
</style>


@stop

@section('order')

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
                                <form method="post" action="{{route('users.updateacc')}}">
                                    @csrf
                                    <div class="name" style="text-align: center; margin-top: 20px ;">
                                        <input type="text" style="text-align: center; font-size:1.8rem;" name="name"
                                            value="{{Auth::user()->name}}" required>


                                    </div>



                                    <div style="font-size:2rem; margin-top:20px ; ">
                                        <div style="display:flex ;">
                                            <div>
                                                Đia chỉ:
                                            </div>
                                            <div>
                                                <textarea type="text"
                                                    style="    text-transform: none; font-size: 1.5rem;width: 21.8em;border-radius: 8px;padding-left:5px; border: 1px solid; border-color: gray"
                                                    name="address" value="">{{Auth::user()->address}} </textarea>

                                            </div>
                                        </div>
                                        <div style="margin-top:10px">
                                            Số điện Thoại:<input type="text" name="phone"
                                                style="width: 17em;font-size: 1.5rem;display:unset" class="form-control"
                                                value="{{Auth::user()->phone}}">
                                        </div>
                                        <div style="margin-top:10px">
                                            Email:<input type="email" name="email"
                                                style="    text-transform: none;margin-left:8.2rem; width: 17em;font-size: 1.5rem;display:unset;"
                                                class="form-control" value="{{Auth::user()->email}}">


                                        </div>
                                        <div style="margin-top:10px">
                                            Password:<input type="password" name="password"
                                                style="    text-transform: none;margin-left:3.8rem; width: 17em;font-size: 1.5rem;display:unset"
                                                class="form-control" value="">


                                        </div>
                                        <button style="margin-right: 10%;margin-left: 70%;" type="submit"
                                            class="btn btn-primary"> Save </button>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-8"
                    style="margin-top:30px;box-shadow: 0 5px 15px -8px rgba(0, 0, 0, .24), 0 8px 10px -5px rgba(0, 0, 0, .2);">


                    <!-- --- -->

                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="card-title" style="text-align: center;">ORDER LIST</h2>


                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Name </th>
                                            <th style="    width: 300px;"> Address </th>
                                            <th> Amount </th>
                                            <th> Total </th>
                                            <th> Order at </th>
                                            <th> Status </th>
                                            <th> Detail </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $item)
                                        <tr>
                                            <td>{{ ++$key}}</td>





                                            <td>{{ $item->name }}</td>


                                            <td>{{ $item-> address }}</td>

                                            <td>{{ $item->item_count }}</td>
                                            <td>{{ $item->grand_total }} đ</td>
                                            <td>{{ $item->created_at }}</td>

                                            <td>

                                                @if($item->status == 'cancel')
                                                <a>cancelled</a>
                                                @elseif($item->status == 'pending')
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <p style="margin-top: 5%;margin-bottom: 5%;">
                                                            {{ $item->status }} </p>
                                                    </div>
                                                    <div class="col-sm">
                                                        <a class="btn btn-danger btn-fw"
                                                            style="  background-color: #ff375f; border-color: #ff375f; float: right; margin-top: 2px;width: 90px;padding: 0;margin-right: 10px;"
                                                            href="{{route('users.ordercancel', $item->order_id)}}">cancel</a>
                                                    </div>
                                                </div>
                                                @else

                                                {{$item->status}}


                                                @endif


                                            </td>
                                            <td><a href="{{route('users.orderdetail',['id' => $item->order_id])}}">chi
                                                    tiet</a></td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>




                    <!-- ----     -->






                </div>
            </div>
        </div>
    </div>
</div>
@endsection

