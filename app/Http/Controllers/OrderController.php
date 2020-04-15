<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\LineRequest;
use App\Product;

class OrderController extends Controller {

    public function create($cost) {
        //save order 
        $user = \Auth::user();

        $order = new Order();
        $order->user_id = $user->id;
        $order->address_id = $user->address_id;
        $order->cost = $cost;
        $order->status = 'verifying';
        $order->save();
        $last_order_id = Order::latest('id')->first();

        //save order-product
        $card = \Session::get('cart');
        foreach ($card as $c) {
            $lineOrder = new LineRequest();
            $lineOrder->order_id = $last_order_id->id;
            $lineOrder->product_id = $c['id'];
            $lineOrder->units = $c['quantity'];
            $lineOrder->save();
        }
        \Session::forget('cart');
    }

    public function get() {
        $current_id = \Auth::user()->id;
        $order = Order::where('user_id', $current_id)->orderBy('id', 'DESC')->get();
        $x=0;
        $newOrder = array();
        foreach($order as $o){
            $date = $o['created_at']->diffForHumans();
            $o['newDate']= $date;
            array_push($newOrder, $o);
            ++$x;
        }
        return $newOrder;
    }

    public function getAll() {
        $order = Order::where('status','!=', 'delivered')->orderBy('id', 'DESC')->get();
        $x=0;
        $newOrder = array();
        foreach($order as $o){
            $date = $o['created_at']->diffForHumans();
            $o['newDate']= $date;
            array_push($newOrder, $o);
            ++$x;
        }
        return $newOrder;
    }

    public function details($id) {
        $orderDetails = LineRequest::where('order_id', '=', $id)->orderBy('id', 'DESC')->get();
        $products = array();
        foreach ($orderDetails as $details) {
            $product = Product::findOrFail($details->product_id);
            $product->quantity = $details->units;
            array_push($products, $product);
        }
        return $products;
    }
    
    public function changeStatus(Request $request) {
        $order = Order::findOrFail($request->id);
        $order->status = $request->newStatus;
        $order->update();
    }
    
    
    
    

}
