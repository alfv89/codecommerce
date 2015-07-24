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
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

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

    /**
     * @param CheckoutService $checkoutService
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function place(CheckoutService $checkoutService)
    {
        if (!Session::has('cart')) {
            return false;
        }

        $cart = Session::get('cart');

        if ($cart->getTotal() > 0) {
            $checkout = $checkoutService->createCheckoutBuilder();

            $order = $this->orderModel->create([
                'total' => $cart->getTotal(),
                'status_id' => 2,
                'user_id' => Auth::user()->id
            ]);

            foreach($cart->all() as $k => $item) {
                $order->items()->create([
                    'price' => $item['price'],
                    'qtd' => $item['qtd'],
                    'product_id' => $k
                ]);

                $checkout->addItem(new Item(
                    $k,
                    $item['name'],
                    number_format($item['price'], 2, ".", ""),
                    $item['qtd']
                ));
            }

            $cart->clear();
            event(new CheckoutEvent(Auth::user(), $order));

            $response = $checkoutService->checkout($checkout->getCheckout());

//            return view('store.checkout', compact('order'));
            return redirect($response->getRedirectionUrl());
        }

        $categories = Category::all();
        return view('store.checkout', ['order'=>'empty', 'categories'=>$categories]);

//        dd($test);

//        DB::transaction(function() {
//            //suas transações, inserções, etc
//        });
    }

    public function test(CheckoutService $checkoutService)
    {
        $checkout = $checkoutService->createCheckoutBuilder()
            ->addItem(new Item(1, 'Televisão LED 500', 8999.99))
            ->addItem(new Item(2, 'Video-game mega ultra blaster', 799.99))
            ->getCheckout();

        $response = $checkoutService->checkout($checkout);

        return redirect($response->getRedirectionUrl());
    }
}