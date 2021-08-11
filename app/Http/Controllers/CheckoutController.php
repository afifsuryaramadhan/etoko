<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        //Simpan data user
        $user = Auth::user();
        $user->update($request->except('total_price'));

        //Proses Checkout
        // $code = 'UMKM-' . mt_rand(000000,999999);
        $carts = Cart::with(['product','users'])
        ->where('user_id', Auth::user()->id)->get();

        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'total' => $request->total_price,
            // 'bukti_tf' => $request->file('bukti_tf')->store(' assets/bukti_tf','public'),
            'status' => 'PROSES',
        ]);

        foreach ($carts as $cart)
        {
            TransactionDetail::create([
            'transaksi_id' => $transaction->id,
            'keranjang_id' => $cart->product->id,
            'user_id' => Auth::user()->id,
            ]);
        }

        return dd($transaction);

        //Delete cart data
        Cart::where('user_id', Auth::user()->id)->delete();
    }






}
