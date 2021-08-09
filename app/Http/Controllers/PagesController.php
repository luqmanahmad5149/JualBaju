<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index() 
    {
        return view('product.index')
            ->with('products', Product::orderBy('updated_at', 'DESC')->paginate(8));
    }

    public function getMoreProducts(Request $request)
    {
        if($request->ajax()){
            $products = Product::orderBy('updated_at', 'DESC')->paginate(8);
            return view('product.pagination_data', compact('products'))->render();
        }
    }

}
