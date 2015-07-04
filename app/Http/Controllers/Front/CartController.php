<?php

namespace CodeCommerce\Http\Controllers\Front;

use CodeCommerce\Cart;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Http\Requests;
use CodeCommerce\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $cart;
    private $productModel;

    /**
     * @param Cart $cart
     * @param Product $product
     */
    public function __construct(Cart $cart, Product $product)
    {
        $this->cart = $cart;
        $this->productModel = $product;
    }

    public function index()
    {
        if (!Session::has('cart')) {
            Session::set('cart', $this->cart);
        }

        return view('store.cart', ['cart' => Session::get('cart')]);
    }

    public function add($id)
    {
        $cart = $this->getCart();

        $product = $this->productModel->find($id);
        $cart->add($id, $product->name, $product->price);

        Session::set('cart', $cart);

        return redirect()->route('store.cart');
    }

    public function remove($id)
    {
        $cart = $this->getCart();
        $cart->remove($id);
        Session::set('cart', $cart);

        return redirect()->route('store.cart');
    }

    /**
     * @return Cart
     */
    private function getCart()
    {
        return (Session::has('cart')) ? Session::get('cart') : $this->cart;
    }
}
