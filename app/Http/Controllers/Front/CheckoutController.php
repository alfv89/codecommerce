<?php

namespace CodeCommerce\Http\Controllers\Front;

use CodeCommerce\Category;
use CodeCommerce\Events\CheckoutEvent;
use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
//            $test = DB::transaction(function() {
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

            $cart->clear();
            event(new CheckoutEvent(Auth::user(), $order));
            return view('store.checkout', compact('order'));
        }

        $categories = Category::all();
        return view('store.checkout', ['order'=>'empty', 'categories'=>$categories]);

//        dd($test);

//        DB::transaction(function() {
//            //suas transações, inserções, etc
//        });
    }
}