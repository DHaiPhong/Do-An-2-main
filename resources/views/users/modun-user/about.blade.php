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
                            <p style="font-size: 2.5rem"><i class="fas fa-shipping-fast"></i> Giao hàng ngay trong vòng 3
                                ngày!</p>
                            <p style="font-size: 2.5rem"><i class="far fa-credit-card"></i> Thanh toán dễ dàng.</p>
                        </div>
                    </div>
                    {{-- 
                    <div class="col-md-6">
                        <p style="font-size: 2.5rem"><i class="fas fa-map"></i>Địa Chỉ</p>
                    </div>
                    <div class="col-md-6" style="padding-right: 2rem">
                        <p style="font-size: 2.5rem"><i class="fas fa-info"></i>Thông Tin</p>
                        <p style="font-size: 2rem; text-align:justify">Chào mừng bạn đến với SneakerViet - một cửa hàng
                            chuyên cung cấp giày
                            sneaker hàng đầu tại Việt Nam!</p>
                        <p style="font-size: 2rem; text-align:justify">Tại SneakerViet, chúng tôi tự hào là địa chỉ tin
                            cậy cho những tín đồ sneaker với sản phẩm đa
                            dạng, phong cách độc đáo và chất lượng hàng đầu. Với mục tiêu mang đến cho khách hàng những trải
                            nghiệm mua sắm tuyệt vời, chúng tôi cam kết luôn cung cấp những đôi giày sneaker phong cách và
                            chất lượng tốt nhất.</p>
                        <p style="font-size: 2rem; text-align:justify">Chúng tôi hiểu rằng việc lựa chọn một đôi giày
                            sneaker không chỉ đơn giản là mua một đôi giày,
                            mà là một phong cách, một cái nhìn về cuộc sống riêng của mỗi người. Vì vậy, chúng tôi luôn nỗ
                            lực để mang đến cho khách hàng những mẫu giày sneaker đa dạng, từ những thiết kế cổ điển đến
                            những xu hướng mới nhất.</p>
                        <p style="font-size: 2rem; text-align:justify">Đội ngũ nhân viên chuyên nghiệp và tận tâm của
                            chúng tôi luôn sẵn sàng lắng nghe và tư vấn cho
                            khách hàng về mọi thắc mắc và yêu cầu. Với dịch vụ giao hàng nhanh chóng và thanh toán dễ dàng,
                            bạn chỉ cần ngồi yên và chờ đợi đôi giày sneaker ưng ý đến từ SneakerViet.</p>
                        <p style="font-size: 2rem; text-align:justify">Hãy đến và khám phá bộ sưu tập giày sneaker phong
                            phú của chúng tôi tại cửa hàng trực tuyến hoặc
                            ghé thăm cửa hàng offline của chúng tôi tại địa chỉ dưới đây:</p>
                        <p style="font-size: 2rem; text-align:justify">Cảm ơn bạn đã lựa chọn SneakerViet để thể hiện
                            phong cách riêng của mình qua đôi giày sneaker!
                            Liên hệ với chúng tôi qua số điện thoại [Số điện thoại] hoặc kết nối với chúng tôi qua mạng xã
                            hội Facebook và Instagram để cập nhật những xu hướng mới nhất và nhận được những ưu đãi đặc
                            biệt.</p>
                        <p style="font-size: 2rem; text-align:justify"> Hãy cùng SneakerViet khám phá thế giới sneaker và
                            thể hiện cái tôi của bạn từ đôi giày bạn chọn!
                        </p>
                        </p>
                    </div> --}}

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
