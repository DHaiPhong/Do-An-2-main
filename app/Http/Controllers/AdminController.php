<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Encore\Admin\Grid\Filter\Where;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use PhpParser\Node\Stmt\Function_;

class AdminController extends Controller
{
    //dashboard
    function dashboard(){
        $sold = DB::table('orders')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->whereIn('status',['pending','completed','processing'])
        ->sum('quantity');
        
        $revenue = DB::table('orders')
        
        ->where('status','completed')
        ->sum('grand_total');
        

        $orders = DB::table('orders')
        ->whereIn('status',['pending','completed','processing'])
        ->count();

        $sells = DB::table('products')
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->select('product_details.sold','product_details.prd_image','products.prd_name')

            ->orderBy('sold','desc')
            
            ->paginate(5);
        
        return view('Admin/modun/dashboard',['sold'=>$sold,'revenue'=>$revenue,'orders'=>$orders,'sells'=>$sells]);
    }



    function chart(Request $request) {
        $entries = Order::select([
            DB::raw('MONTH(created_at) as month'),
//            DB::raw('YEAR(created_at) as year'),
            DB::raw('SUM(grand_total) as grand_total'),
           
        ])
        
        ->whereYear('created_at', 2023)
        ->where('status','completed')
        ->groupBy([
            'month'
        ])
        ->orderBy('month')
        ->get();

        
        $labels = [
            1 => 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

//        $dataset = [];
        $grand_total = [];

        foreach ($entries as $entry){
//            if ($entry->status == 'Gửi Thành Công') {
                $grand_total[$entry->month] = $entry->grand_total;
                
//            }
        }

        foreach ($labels as $month => $name){
            if (!array_key_exists($month, $grand_total)) {
                $grand_total[$month] = 0;
            }
            
        }

        ksort($grand_total);
        

        return [
            'labels' => array_values($labels),
            'datasets' => [
                [
                    'label' => 'Revenue(vnd)',
                    'borderWidth' => 1,
                    'data' => array_values($grand_total),
                    
                ],
                
            ]
        ];
    }







    //---End Dashboard

    //---cac trang---
    function account(){
        $users = DB::table('users')->get();
        return view('Admin.modun.account',['user1'=>$users]);
    }
    function product(){
        $products = DB::table('products')
        
        ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
        ->join('category', 'products.cat_id', '=', 'category.id')
        ->orderBy('product_details.prd_id')
        ->paginate(8);
        return view('Admin.modun.product',['products'=>$products]);
    }
    function productorderby($id){
        if($id == 'amount'){
        $products = DB::table('products')
        ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
        ->join('category', 'products.cat_id', '=', 'category.id')
        ->orderBy('product_details.prd_amount','desc')
        ->paginate(8);
        } elseif ($id == 'id') {
            $products = DB::table('products')
                ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
                ->join('category', 'products.cat_id', '=', 'category.id')
                ->orderBy('product_details.prd_detail_id', 'asc')
                ->paginate(8);
        }elseif($id == 0){
            $products = DB::table('products')
                ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
                ->join('category', 'products.cat_id', '=', 'category.id')
                ->where('product_details.prd_amount',0)
                ->paginate(8);
        }
        else{
        $products = DB::table('products')
        ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
        ->join('category', 'products.cat_id', '=', 'category.id')
        ->orderBy('product_details.sold','desc')
        ->paginate(8);
        }
        return view('Admin.modun.product',['products'=>$products]);
    }

    //---sua account---
    function modify($id){
        $user = DB::table('users')->where('id',$id)->first();
        return view ('Admin.modun.detail', compact('user'));
    }

    function delete(Request $request, $id){
        $data = [
            'status' => 1
        ];
        DB::table('users')->where('id', $request->id)
            ->update($data);
        return redirect()-> route('admin.account');
    }

    function edit(Request $request, $id){
        $data = [
            
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'address' => $request->address,
            'phone' => $request->phone,
            'level' => $request->level
        ];
        DB::table('users')->where('id', $request->id)
            ->update($data);
        return redirect()-> route('admin.account');
    }
    //---
    //---Sua product---
    function prd_modify($id){
        $product = DB::table('products')
        ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
        ->join('category', 'products.cat_id', '=', 'category.id')
        ->where('prd_detail_id', $id)->first();
        return view ('Admin.modun.prd_detail', compact('product'));
    }

    function prd_edit(Request $request, $id){
        if($request->prd_image == null){

            $data = [
            
            'prd_name' => $request->prd_name,
            'cat_id' => $request->cat_id,
            'prd_color' => $request->prd_color,
            'price' => $request->prd_price,
            'prd_amount' => $request->prd_amount,
            'prd_size' => $request->prd_size,
            'prd_details' => $request->prd_details,
            
            'prd_sale' => $request->prd_sale
        ];
        }else{
        $data = [
            
            'prd_name' => $request->prd_name,
            'cat_id' => $request->cat_id,
            'prd_color' => $request->prd_color,
            'price' => $request->prd_price,
            'prd_amount' => $request->prd_amount,
            'prd_size' => $request->prd_size,
            'prd_details' => $request->prd_details,
            'prd_image' => $request->prd_image,
            'prd_sale' => $request->prd_sale
        ];
}
        DB::table('products')
        ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
        ->where('prd_detail_id', $request->id)
        ->update($data);
        

        return redirect()-> route('admin.product');
    }


    //---------------add prd---------------
    function prd_add(Request $request){
        if($request->newprd == null){
            
        }else{

        $prd = [
                    
                'prd_name' => $request->newprd,
                'cat_id' => $request->cat_id,
                'price' => $request->prd_price, 
                'prd_details' => $request->prd_details, 
                'prd_sale' => $request->prd_sale
                ];
         
        DB::table('products')
        ->insert($prd);       
        }   
            
        if ($request->newprd == null) {
            $prddetail = [
            'prd_id' => $request->prd_id,
            'prd_color' => $request->prd_color,
            'prd_amount' => $request->prd_amount,
            'prd_size' => $request->prd_size
            ];
            
            
        }else{
            $temp = DB::table('products')
                ->max('prd_id');
            
           $prddetail = [
            'prd_id' => $temp,
            'prd_color' => $request->prd_color,
            'prd_amount' => $request->prd_amount,
            'prd_size' => $request->prd_size
            ];
                 
        }

        
        DB::table('product_details')
        ->insert($prddetail);
        return redirect()-> route('admin.product');
    }

    function addprdform() {
        $products = DB::table('products')
            ->get();
        return view('Admin/modun/addprd',compact('products'));
    }

    //--------------End add prd
    function order(){
        $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->groupBy('orders.id')
            ->orderByDesc('orders.id')
            ->paginate(6);
        return view ('Admin.modun.order', compact('orders'));
    }

    function orderdetail($id){
        $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('product_details','order_items.product_id','=','product_details.prd_detail_id')
            ->join('products','products.prd_id','=','product_details.prd_id')
            ->where('orders.id',$id)
            ->get();
       
        return view ('Admin.modun.orderdetail', compact('orders'));
    }

    function updateStatus($id,$value)
    {
        $order = DB::table('orders')
        ->where('id',$id)
        ->first();
        
        
        if($order->status == 'cancel'){
            
        }else if($value == "processing"){
            $order=DB::table('orders')
            ->where('id',$id)
            ->update(['status' => 'processing']);
            
        }
        else if($value == "completed"){
            $order=DB::table('orders')
            ->where('id',$id)
            ->update(['status' => 'completed']);
            
        }
    
        return redirect()-> route('admin.order');
    }

    function orderorderby($id){
        if($id == 'pending'){
            $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->groupBy('orders.id')
            ->where('orders.status',$id)
            ->orderByDesc('orders.id')
            ->paginate(5);

        }
        else if( $id == 'completed'){
            $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->groupBy('orders.id')
            ->where('orders.status',$id)
            ->orderByDesc('orders.id')
            ->paginate(6);

        }else if( $id  == 'processing'){
            $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->groupBy('orders.id')
            ->where('orders.status',$id)
            ->orderByDesc('orders.id')
            ->paginate(6);

        }else if( $id == 'cancel' ){
            $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->groupBy('orders.id')
            ->where('orders.status',$id)
            ->orderByDesc('orders.id')
            ->paginate(6);

        }else{
            $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->groupBy('orders.id')
            ->orderByDesc('orders.id')
            ->paginate(6);
        }
        return view ('Admin.modun.order', compact('orders'));   
    }

//------------------Add img------------------
function storeimg(Request $request,$id){
    $this->validate($request, [
        'images' => 'required',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);
    $input=$request->all();
    $images=array();
    if($files=$request->file('images')){
        foreach($files as $file){
            $name=$file->getClientOriginalName();
            $file->move('image',$name);
            $images[]=$name;
        }
    }
        
    /*Insert your data*/
    foreach($images as $image){
        DB::table('imgprds') 
        ->insert( [
        'img'=>  $image,
        'prd_id' =>$id,
        
    ]);

    }
    


    return back();

}

}