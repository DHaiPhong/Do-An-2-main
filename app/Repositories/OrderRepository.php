<?php

namespace App\Repositories;


use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Contracts\OrderContract;
use Gloudemans\Shoppingcart\Facades\Cart;



class OrderRepository extends BaseRepository implements OrderContract
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function storeOrderDetails($params)
    {
        $order = Order::create([
            'order_number'      =>  'ORD-' . strtoupper(uniqid()),
            'user_id'           =>  auth()->user()->id,
            'status'            =>  $params['status'],
            'grand_total'       =>  $params['total'],
            'item_count'        =>  Cart::count(),
            'name'              =>  $params['name'],
            'address'           =>  $params['address'],
            'email'             =>  $params['email'],
            'city'              =>  $params['city'],
            'district'          =>  $params['district'],
            'pay_method'        =>  $params['pay_method'],
            'phone_number'      =>  $params['phone']
        ]);

        
        if ($order) {



            foreach (Cart::content() as $item) {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = Product::where('prd_name', $item->name)->first();

                $orderItem = new OrderItem([
                    'product_id'    =>  $item->id,
                    'quantity'      =>  $item->qty,
                    'price'         =>  $item->total
                ]);

                $order->items()->save($orderItem);
            }
        }

        return $order;
    }
}
