<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use App\Contracts\OrderContract;
use Cart;

class CheckoutController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getCheckout()
    {
        return view('users.modun-user.payment', ['title' => 'Payment']);
    }

    public function placeOrder(PaymentRequest $request)
    {
        // Before storing the order we should implement the
        // request validation which I leave it to you

        $order = $this->orderRepository->storeOrderDetails($request->all());


        return redirect()->route('cart.success');
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function online(Request $request)
    {

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $_POST['total_momo'];
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/momo/success";
        $ipnUrl = "http://127.0.0.1:8000/momo/success";
        $extraData = "";


        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        // dd($signature);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        // dd($result);
        $jsonResult = json_decode($result, true);  // decode json

        $payUrl = $jsonResult['payUrl'];
        // return redirect()->route('cart.success');
        return redirect()->to($payUrl);
    }

    public function momoSuccess(Request $request)
    {
        // kiểm tra xem thanh toán có thành công hay không bằng cách kiểm tra statusCode từ MOMO
        if ($request->get('errorCode') == 0) { // nếu errorCode = 0, thanh toán thành công 
            // Thanh toán thành công, lưu đơn hàng vào CSDL
            $orderData = [
                'name' => auth()->user()->name,
                'address' => auth()->user()->address,
                'email' => auth()->user()->email,
                'city' => 'Thành phố',
                'phone' => auth()->user()->phone,
                'amount' => $request->get('amount')
            ];
            $order = $this->orderRepository->storeOrderDetails($orderData);
        }
        return redirect()->route('cart.success');
    }
}
