@extends('Admin.master')

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection

@section('content')
    <div class="main-panel">
        <div class="content-wrapper" style="float: right; width: 80%;">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span> Dashboard
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <span></span> Tổng Quan <i
                                class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <h4 class="font-weight-normal mb-3">Đã Bán <i
                                    class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                            </h4>
                            <h2 class="mb-5">{{ $sold }}</h2>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-success card-img-holder text-white">
                        <div class="card-body">
                            <h4 class="font-weight-normal mb-3">Đơn Hàng <i
                                    class="mdi mdi-diamond mdi-24px float-right"></i>
                            </h4>
                            <h2 class="mb-5">{{ $orders }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-info card-img-holder text-white">
                        <div class="card-body">

                            <h4 class="font-weight-normal mb-3">Doanh Thu <i
                                    class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                            </h4>
                            <h2 class="mb-5">{{ number_format($revenue) }} Đ</h2>

                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-8">
                    {{-- <div id="chart"></div> --}}
                    <div class="stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Danh Thu Theo Tháng</h4>
                                <div>
                                    <canvas id="myChart"></canvas>
                                </div>
                                <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Top 5 Sản Phẩm</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> # </th>
                                                <th> Tên </th>
                                                <th> Hình Ảnh </th>
                                                <th> Đã Bán </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sells as $key => $sell)
                                                <tr>
                                                    <td> {{ ++$key }} </td>
                                                    <td><a
                                                            href="{{ route('admin.prd_detail', ['id' => $sell->prd_detail_id]) }}">{{ $sell->prd_name }}</a>
                                                    </td>
                                                    <td>
                                                        <img src="/anh/{{ $sell->prd_image }}" width="110px ">
                                                    </td>
                                                    <td>{{ $sell->t_sold }} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Sản phẩm sắp hết hàng</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th> # </th>
                                                <th> Tên </th>
                                                <th> Hình Ảnh </th>
                                                <th>Size</th>
                                                <th> Còn Lại </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($out_of_stocks as $key => $out_of_stock)
                                                <tr>
                                                    <td> {{ ++$key }} </td>
                                                    <td><a
                                                            href="{{ route('admin.prd_detail', ['id' => $out_of_stock->prd_detail_id]) }}">{{ $out_of_stock->prd_name }}</a>
                                                    </td>
                                                    <td>
                                                        <img src="/anh/{{ $out_of_stock->prd_image }}" width="110px ">
                                                    </td>
                                                    <td> {{ $out_of_stock->prd_size }}</td>
                                                    <td>{{ $out_of_stock->prd_amount }} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        fetch("{{ route('chart') }}")
            .then(response => response.json())
            .then(json => {
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: json.labels,
                        datasets: json.datasets
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
    </script>
@endsection
