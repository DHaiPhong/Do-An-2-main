@extends('users.masterUser')

@section('content')
    <section class="container mt-5">
        <div class="card" style="background-color: #FFF; padding: 5rem">
            <div class="text-center">
                <p style="font-size: 5rem">Chào Mừng Đến Với SneakerViet!</p>
                <div class="row">
                    <div class="image-container-about">
                        <img src="{{ asset('anh/about-1.jpg') }}" alt="" width="500px" height="auto">

                        <div class="text">
                            <p style="font-size: 3.5rem; color: #FFF; text-align: center;">Về SneakerViet</p>
                            Chào mừng bạn đến với SneakerViet, nơi chúng tôi cung cấp sản phẩm đa dạng, phong cách độc đáo
                            và chất lượng cao. Chúng tôi cam kết
                            tư vấn tận tâm để bạn tìm thấy đôi sneaker ưng ý nhất. Hãy để chúng tôi giúp bạn thể hiện cái
                            tôi thông qua lựa chọn giày của bạn. Hãy liên hệ với chúng tôi hoặc ghé thăm cửa hàng của chúng
                            tôi để khám phá thế giới sneaker tuyệt vời này.
                            <p style="font-size: 2.5rem; margin-top: 1rem"><i class="far fa-clock"></i> Thời gian làm việc:
                                24/7.</p>
                            <p style="font-size: 2.5rem"><i class="fas fa-shipping-fast"></i> Giao hàng ngay trong vòng 4
                                ngày!</p>
                            <p style="font-size: 2.5rem"><i class="far fa-credit-card"></i> Thanh toán dễ dàng.</p>
                        </div>
                    </div>
                    <div style="flex-wrap:wrap;padding:10px 50px;" class="d-flex justify-content-center">
                        <style>
                            .table1 {
                                flex-basis: 45%;
                                min-width: 400px;
                            }

                            .image-column1 {
                                width: 20%;
                                padding: 10px;
                                vertical-align: auto;
                                border: 1px solid #ccc;
                                outline: none;
                                border: none;
                            }
                        </style>
                        <table class="table1">
                            <tr>
                                <td class="image-column1"><img src="/anh/qq1.png" alt="placeholder"></td>
                                <td class="text-column1">
                                    <h2>Chất lượng sản phẩm?</h2>
                                    <p>Sản phẩm luôn được VNSneakers kiểm tra và đánh giá chất lượng cao nhất trước khi đạt
                                        khách hàng!</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="image-column1"><img src="/anh/qq2.png" alt="placeholder"></td>
                                <td class="text-column1">
                                    <h2>Thời gian giao hàng?</h2>
                                    <p>Chúng tôi sử dụng đơn vị vận chuyển uy tín nhất, nhanh nhất, thời gian ước tính từ
                                        1-4 ngày
                                        tùy thuộc vào khu vực.</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="image-column1"><img src="/anh/qq3.png" alt="placeholder"></td>
                                <td class="text-column1">
                                    <h2>Màu sắc sản phẩm sai?</h2>
                                    <p>Do một số yếu tố khách quan như độ sáng màn hình, chất lượng màn hình nên sản phẩm có
                                        thể không
                                        được như ý.
                                        đúng màu.</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="image-column1"><img src="/anh/qq4.png" alt="placeholder"></td>
                                <td class="text-column1">
                                    <h2>Thời gian làm việc?</h2>
                                    <p>Hệ thống cửa hàng và Online làm việc 24/7.</p>
                                </td>
                            </tr>

                        </table>
                        <table class="table1">
                            <tr>
                                <td class="image-column1"><img src="/anh/qq5.png" alt="placeholder"></td>
                                <td class="text-column1">
                                    <h2>Hàng có sẵn không?</h2>
                                    <p>Sản phẩm có bán tại hệ thống cửa hàng VNSneakers và online tại website.</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="image-column1"><img src="/anh/qq6.png" alt="placeholder"></td>
                                <td class="text-column1">
                                    <h2>Đổi hàng như thế nào?</h2>
                                    <p>Trao đổi rất dễ dàng và chúng tôi luôn muốn khách hàng hài lòng. Vui lòng liên hệ
                                        fanpage để
                                        thay đổi!</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="image-column1"><img src="/anh/qq7.png" alt="placeholder"></td>
                                <td class="text-column1">
                                    <h2>Bảo hành sản phẩm</h2>
                                    <p>Sản phẩm được bảo hành 30 ngày đối với bất kỳ lỗi nào. Hàng SALE không bảo hành.</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="image-column1"><img src="/anh/qq8.png" alt="placeholder"></td>
                                <td class="text-column1">
                                    <h2>Cỡ giày sai?</h2>
                                    <p>Bạn có thể đến cửa hàng hoặc gửi lại để đổi với sản phẩm mới 100%. Vẫn còn thẻ
                                        và hóa đơn mua hàng.</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <p style="font-size: 2.5rem">Liên hệ:</p>
                    <div style="display:flex;     justify-content: center;    align-items: center;">
                        <p style="font-size: 2.5rem; margin-right: 1rem"><i class="fas fa-phone"></i>09999999999</p>
                        <div class="social-icons" style="font-size: 3rem">
                            <a href="https://www.facebook.com/profile.php?id=100004525787274" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/yourcompany" target="_blank"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="mailto:ohi.phong@gmail.com"><i class="far fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
