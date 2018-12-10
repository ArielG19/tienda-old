<?php

namespace App\Http\Controllers\Controladores;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Session;
use App\Cart;
use App\Order;
use Auth;
use Stripe\Charge;
use Stripe\Stripe;


class ProductosController extends Controller
{
     public function producto()
    {
        $products = Product::all();
        return view('shopping.master')->with('products',$products);
    }

    public function addToCart(Request $request, $id)
    {
      $product = Product::find($id);
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      //instaciamos un nuevo objeto.
      $cart = new Cart($oldCart);
      $cart->add($product, $product->id);

      $request->Session()->put('cart',$cart);
      return redirect()->route('product.index');
    }

    public function getReducebyOne($id){
      $oldCart = Session::has('cart') ? Session::get('cart'): null;
      $cart = new Cart($oldCart);
      $cart->reduceByOne($id);
      
      if(count($cart->items)>0){
        Session::put('cart', $cart);
      }else{
        Session::forget('cart');
      }
      
      return redirect()->route('product.shoppingcart');
    }
    public function getRemoveItem($id){
      $oldCart = Session::has('cart') ? Session::get('cart'): null;
      $cart = new Cart($oldCart);
      $cart->removeItem($id);

      if(count($cart->items)>0){
        Session::put('cart', $cart);
      }else{
        Session::forget('cart');
      }
      
      return redirect()->route('product.shoppingcart');
    }

    public function getcart()
    {
        if (!Session::has('cart')){
            return view('shopping.shopping-cart',['products'=>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shopping.shopping-cart',['products'=>$cart->items,'totalprice'=>$cart->totalprice]);
    }
    public function getcheckout()
    {
     if (!Session::has('cart')) {
        return view('shopping.shopping-cart');
      } 
      $oldCart= Session::get('cart');
      $cart= new Cart($oldCart);
      $total= $cart->totalprice;
      return view('shopping.checkout',['total'=> $total]);
    }

    public function postcheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('shopping.shoppingcart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        Stripe::setApiKey('sk_test_m68CyrY8llBUHcjEp4xKb8WF '); 

        // agregamos $charge cuando hicimos el model order
        try {
           $charge = Charge::create(array(
                "amount" => $cart->totalprice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtained with first code i wrote above
                "description" => "Test Charge"
            ));
           //agregamos esto despues de crear el modelo order
           $order = new Order();
           $order->cart = serialize($cart);
           $order->address = $request->input('address');
           $order->name = $request->input('name');
           $order->payment_id =$charge->id;
           Auth::user()->orders()->save($order);
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
        Session::forget('cart');
        return redirect()->route('product.index')->with('success', 'Producto comprado con èxito!');
    }

}
