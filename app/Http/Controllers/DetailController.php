<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $product = Product::with(['gambar','users'])->where('id', $id)->firstOrFail();
        return view('pages.detail',[
            'product' => $product
        ]);
    }

    public function add(Request $request, $id)
    {
        $data = [
            'produk_id' => $id,
            'user_id' => Auth::user()->id,
            // 'kuantitas' => $kuantitas,
            // 'status' => isset ? 1 : 0,
        ];

        $cart = Cart::where('produk_id', $id);
        if($cart->count())
        {
            $cart->increment('kuantitas');
            $cart = $cart->first();
        }else{

        Cart::create($data);
        }

        return redirect()->route('cart');
    }
}
