<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $categories = Category::all();
        $products = Product::with(['gambar'])->paginate(32);
        return view('pages.category',[
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function detail(Request $request, $slug)
    {

        $categories = Category::all();
        $category = Category::where('id', $slug)->firstOrFail();
        $products = Product::with(['gambar'])->where('kategori_id', $category->id)->paginate(32);
        return view('pages.category',[
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
