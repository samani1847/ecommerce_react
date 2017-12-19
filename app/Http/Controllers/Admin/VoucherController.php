<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Voucher;
use App\Model\Cart;
use Auth, Rest;

class VoucherController extends Controller
{
    public function useVoucher(Request $request){    
    
        $code = $request->input("code");
        
        $voucher = Voucher::where("code",'=', $code)
                    ->where('status', '=', 1)
                    ->where('start_date', "<=",\Carbon\Carbon::now()->format('Y-m-d'))
                    ->where('end_date', ">=",\Carbon\Carbon::now()->format('Y-m-d'))
                    ->whereRaw('voucher.max_claim > voucher.claimed')->first();

        if($voucher){
            // $cart = Cart::where("user_id", '=', Auth::id())->first();
            // $cart_total = $cart->getTotal();
            
            // $discount = $cart_total->total_price * $voucher->discount /100;

            // $final_total = $cart_total->total_price - $discount; 
            return Rest::success("Ok", ['voucher'=> $voucher->discount]);
        }

        return Rest::error('voucher not found');
        

    }
}
