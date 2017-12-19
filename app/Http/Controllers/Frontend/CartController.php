<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, Rest, Validator;
use App\Model\Cart;
use App\Model\CartDetail;


class CartController extends Controller
{
    public function addToCart(Request $request){
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(), ['product_id'=> 'required|integer']);

        if($validator->fails()){
            return Rest::error('Error parameter');
        }
        $cart = Cart::where('user_id', '=', $id)->first();

        if(!$cart){
            $cart = Cart::create(['user_id' =>$id]);            
        }

        $product_id = $request->input('product_id');

        $cartDetail = CartDetail::where('cart_id','=',$cart->id)->where('product_id','=',$product_id)->first();
        
        if(!$cartDetail){
            $data = [
                'cart_id' => $cart->id,
                'product_id' => $request->input('product_id')
            ];
    
            CartDetail::create($data);    
        }
        
        $cart = Cart::where('user_id','=', Auth::id())->with('detail.product')->first();
        
        $result = $this->transform_data($cart);
        // var_dump($cart->detail);
        return Rest::success("Successfully add to cart", $result);
        
    }

    private function _total_price($detail_cart){
        $total = 0;
        $item = 0;
        foreach ($detail_cart as $key => $det){
            $total+= $det->product->price;
            $item++;
        }

        return ['total'=> $total, 'item' => $item];
    }
    
    public function transform_data($cart){

        if(!$cart ||  !$cart->detail){
            return ['cart' => null,
                'cartTotal' => 0,
                'cartItem' => 0];
        }

        $cart = Cart::where('user_id','=',2)->with('detail.product')->first();
        
        $result = $this->_total_price($cart->detail);
        $return = ['cart' => $cart->detail,
                    'cartTotal' => $result['total'],
                    'cartItem' => $result['item']
        ];
        return $return;
        // $cartTotal = $cart->count;
    }

   
    //delete cart detail
    public function delete(Request $request, $id){
        
        try{
            $cartDetail = CartDetail::findOrFail($id);
            $cartDetail->delete();
            $cart = $this->getCart();

            return Rest::success('Cart is deleted successfully', $cart );

        } catch(Exception $e){
            
            return Rest::error('Error deleting data');

        }

     
    }
    
    public function getCartData(){

        $cart_data = $this->getCart();
        
        return Rest::success('Successfully load cart', $cart_data);
    }

    private function getCart(){

        $cart = Cart::where('user_id', '=',Auth::id())->with('detail.product')->first();
        return $this->transform_data($cart);
    }
}
