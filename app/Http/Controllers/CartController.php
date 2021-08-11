<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carts = Cart::with(['product.gambar','users'])->where('user_id', Auth::user()->id)->get();
        return view('pages.cart',[
            'carts' => $carts
        ]);
    }

    public function delete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart');
    }

    public function success()
    {
        return view('pages.success');
    }

    public function ongkir(Request $request)
    {
        // dd($request->all());
        // $response = Http::withHeaders([
        //     'key' => '4afd1954d5b0a88b43a793f6d7429497'
        // ])->get('https://api.rajaongkir.com/starter/province');
        // return $response->body();

        // if($request->origin && $request->destination && $request->weight && $request->courier)
        // {
        //     $origin = 252;
        //     $destination = $request->regencies_id;
        //     $weight = 1700;
        //     $courier = $request->kurir;
        // }
        // else
        // {
        //     $origin = '';
        //     $destination = '';
        //     $weight = '';
        //     $courier = '';
        // }

        $origin = 252;
        $destination = $request->regencies_id;
        $weight = 1000;
        $courier = $request->kurir;

        $response = Http::asForm()->withHeaders([
            'key' => '4afd1954d5b0a88b43a793f6d7429497'
        ])->post('https://api.rajaongkir.com/starter/cost',[
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier
        ]);

        return $response['rajaongkir']['results'][0]['costs'];
        // return view('pages.cart', compact('cekongkir'));
        return view('pages.cart',[
            // 'cekongkir' => $cekongkir
        ]);
    }

}
