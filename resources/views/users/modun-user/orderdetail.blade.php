@extends('users.masterUser')

@section('css')
@stop
@section('content')
    <section class="h-100 gradient-custom" style="padding:0;font-size:17px;margin-bottom:200px">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
    @if (session('message'))
                <h1 class="text-primary">{{ session('message') }}</h1>
            @endif
      <div class="col-lg-10 col-xl-8">
        <div class="card" style="border-radius: 10px;">
          <div class="card-header px-4 py-5">
            <h5 class="text-muted mb-0" style="font-size:17px;">Cảm ơn đã đặt hàng bạn đã đặt hàng, <span style="color: #a8729a;">{{Auth::user()->name}}</span>!</h5>
          </div>

          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0" style="color: #a8729a;font-size:17px;">Receipt</p>
              <p class="small text-muted mb-0">Mã đơn hàng : {{ $odnb->order_number }}</p>
            </div>
            @foreach ($orders as $item)
            <div class="card shadow-0 border mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <img src="/anh/{{ $item->prd_image }}"
                      class="img-fluid" alt="Phone">
                  </div>
                  <div class="col-md-5 text-center d-flex justify-content-center align-items-center">
                    <a class="text-muted mb-0" style="text-decoration: none"
                                    href="{{ route('users.productdetail', ['id' => $item->slug]) }}">{{ $item->prd_name }}</a>
                  </div>
                  <div class="col-md-1 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small">Size: {{ $item->prd_size }}</p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small">Số lượng: {{ $item->quantity }}</p>
                  </div>
                  
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small">{{ number_format($item->price) }} đ</p>
                  </div>
                </div>
                <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
              </div>
            </div>
            @endforeach

            <div class="d-flex justify-content-between pt-2">
              <!-- <p class="fw-bold mb-0">Order Details</p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span> {{number_format($odnb->grand_total)}} đ</p> -->
            </div>

            <div class="d-flex justify-content-between pt-2">
              <p class="text-muted mb-0">Ngày đặt hàng : {{$odnb->created_at}}</p>
              <!-- <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span> $19.00</p> -->
            </div>

            <div class="d-flex justify-content-between">
                @if($odnb->status == 'completed')
                <p class="text-muted mb-0">Ngày nhận hàng : {{$odnb->updated_at}}</p>
                @elseif($odnb->status == 'cancel')
                <p class="text-muted mb-0">Ngày nhận hàng : Đơn hàng đã bị hủy</p>
                @else
                <p class="text-muted mb-0">Ngày nhận hàng : chưa có</p>
                @endif
              <!-- <p class="text-muted mb-0"><span class="fw-bold me-4">GST 18%</span> 123</p> -->
            </div>

            <div class="d-flex justify-content-between mb-5">
              <p class="text-muted mb-0">Trạng thái đơn hàng : {{ $odnb->status }}</p>
              <!-- <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> Free</p> -->
            </div>
          </div>
          <div class="card-footer border-0 px-4 py-5"
            style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
            <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0" style="font-size:17px;">Total
              paid: <span class="h2 mb-0 ms-2">{{number_format($odnb->grand_total)}} đ</span></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
