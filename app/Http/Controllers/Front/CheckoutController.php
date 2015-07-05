<?php

namespace CodeCommerce\Http\Controllers\Front;

use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    private $orderModel;
    private $orderItemModel;

    /**
     * @param Order $order
     * @param OrderItem $orderItem
     */
    public function __construct(Order $order, OrderItem $orderItem)
    {
        $this->middleware('auth');
        $this->orderModel = $order;
        $this->orderItemModel = $orderItem;
    }

    public function place()
    {
        if (!Session::has('cart')) {
            return false;
        }

        $cart = Session::get('cart');

        if ($cart->getTotal() > 0) {
//            DB::transaction(function() {
                $order = $this->orderModel->create([
                    'total' => $cart->getTotal(),
                    'user_id' => Auth::user()->id
                ]);

                foreach($cart->all() as $k => $item) {
                    $order->items()->create([
                        'price' => $item['price'],
                        'qtd' => $item['qtd'],
                        'product_id' => $k
                    ]);
                }
//            });
        }

        dd($order);

//        DB::transaction(function() {
//            //suas transações, inserções, etc
//        });
    }
}
