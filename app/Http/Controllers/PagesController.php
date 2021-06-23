<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PagesController extends Controller
{
    public function index() 
    {
        return view('product.index')
            ->with('products', Product::orderBy('updated_at', 'DESC')->paginate(8));
    }


}
