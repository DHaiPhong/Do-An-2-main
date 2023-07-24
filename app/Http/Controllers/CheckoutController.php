<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use App\Contracts\OrderContract;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getCheckout()
    {
        return view('users.modun-user.payment', ['title' => 'Thanh Toán']);
    }

    public function placeOrder(PaymentRequest $request)
    {
         
        foreach(Cart::content() as $item){
            $data = DB::table('product_details')
            ->where('prd_detail_id',$item->id)
            ->first();
           
            if( $data->prd_amount == 0){
                Cart::remove($item->rowId);
                return redirect()->route('users.cartshop')->with(['message' => 'Xin lôi Quý khách sản phẩm bạn vừa đặt đã hết hàng!']);
            }
        }
        if ($request->coupon_type == 'fixed') {
            $total = Cart::total() + $request->ship - $request->coupon_amount;
        } else {
            $total = Cart::total() + $request->ship - (Cart::total() * $request->coupon_amount / 100);
        }

        if ($total < 0) {
            $total = 0;
        }
        session()->put([
            'ship' => $request->ship,
            
        ]);

        $order = $this->orderRepository->storeOrderDetails([
            "_token" => $request->_token,
            "name" => $request->name,
            "email" => $request->email,
            "city" => $request->city,
            "address" => $request->address,
            "phone" => $request->phone,
            "district" => $request->district,
            "pay_method" => 'Tiền mặt',
            'status' => 'pending',
            "total" => $total
        ]);


        Session::forget(['id', 'amount', 'code', 'expires_at', 'type']);

        return redirect()->route('cart.success');
    }

    function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
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
        foreach(Cart::content() as $item){
            $data = DB::table('product_details')
            ->where('prd_detail_id',$item->id)
            ->first();
           
            if( $data->prd_amount == 0){
                Cart::remove($item->rowId);
                return redirect()->route('users.cartshop')->with(['message' => 'Xin lôi Quý khách sản phẩm bạn vừa đặt đã hết hàng!']);
            }
        }
        if ($request->coupon_type == 'fixed') {
            $total = Cart::total() + $request->ship - $request->coupon_amount;
            
        } else {
            $total = Cart::total() + $request->ship - (Cart::total() * $request->coupon_amount / 100);
        }
            session()->put([
                'ship' => $request->ship,
                
            ]);
            
           
        if ($total < 0) {
            $total = 0;
        }
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = $request->city;

        $amount = $total;

        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/momo/success";
        $ipnUrl = "http://127.0.0.1:8000/momo/success";
        $extraData = $request->district;
        $ship = $request->ship;
        
        $items = [
            'id' => "204727",  
            'name'=> "YOMOST Bac Ha&Viet Quat 170ml",  
            'description' => "YOMOST Sua Chua Uong Bac Ha&Viet Quat 170ml/1 Hop",
            'category' => "beverage",
            'imageUrl' => "https://momo.vn/uploads/product1.jpg",
            'manufacturer' => "Vinamilk",
            'price' =>  11000,               
            'quantity' => 5,
            'currency' => 50000,
            'totalPrice' =>  55000,
            
        ];
        



        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType  ;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        
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
            'signature' => $signature,
            

            
        );
        
        
        $result = $this->execPostRequest($endpoint,json_encode($data) );
        
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
                'city' => $request->orderInfo,
                'phone' => auth()->user()->phone,
                'status' => 'processing',
                'pay_method' => 'MoMo',
                'district' => $request->extraData,
                'total' => $request->get('amount'),
                
            ];
            
            $order = $this->orderRepository->storeOrderDetails($orderData);
        }
        return redirect()->route('cart.success');
    }
}
