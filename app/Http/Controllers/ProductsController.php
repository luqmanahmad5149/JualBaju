<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Products;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index')
            ->with('products', Product::orderBy('updated_at', 'DESC')->paginate(8));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:5048',
        ]);

        $newImageName = uniqid() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id,
            'slug' => SlugService::createSlug(Product::class, 'slug', $request->name),
        ]);

        return redirect('/product')
            ->with('message', 'Your product has been added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('product.show')
            ->with('product', Product::where('slug', $slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('product.edit')->with('product', Product::where('slug', $slug)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);

        Product::where('slug', $slug)
            ->update([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'category' => $request->input('category'),
                'description' => $request->input('description'),
                'user_id' => auth()->user()->id,
                'slug' => SlugService::createSlug(Product::class, 'slug', $request->name),
            ]);

        return redirect('/product')->with('message', 'Your product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $product = Product::where('slug', $slug);
        $product->delete();

        return redirect('/')->with('message', 'Your product has been deleted!');        
    }

    public function addToCart(Request $request)
    {
        if (auth()->user())
        {
            Cart::create([
                'product_id' => $request->input('product_id'),
                'user_id' => auth()->user()->id,
            ]);
    
            return redirect('/')
            ->with('message', 'Product added to cart!');
        }
        else
        {
            return redirect('/login');
        }

    }

    public static function cartItem()
    {
        $userId = auth()->user()->id;

        return Cart::where('user_id', $userId)->count();
    }

    public function cartList()
    {
        $userId = auth()->user()->id;

        $products = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $userId)
            ->select('products.*','carts.id as cart_id' )
            ->get();

            return view('product.cartlist')->with('products', $products);
    }

    public function removeCart($id)
    {
        $cart = Cart::where('id', $id);
        $cart->delete();

        return redirect('/cartlist');     
    }

    public function orderNow()
    {
        $userId = auth()->user()->id;

        $total = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $userId)
            ->sum('products.price');

        $user = DB::table('users')->where('id', $userId)->first();

        return view('product.ordernow', compact('total', 'user'));
    }

    public function orderPlace(Request $request)
    {
        $userId = auth()->user()->id;

        $allCart = Cart::where('user_id', $userId)->get();
        foreach( $allCart as $cart)
        {
            $order = new Order;
            $order->product_id = $cart['product_id'];
            $order->user_id = $cart['user_id'];
            $order->address = $request->input('address');
            $order->payment_method = $request->input('payment');
            $order->payment_status = 'Succesful';
            $order->status = 'On Delivery';
            $order->save();
            Cart::where('id', $cart['id'])->delete();
        }

        return redirect('/');
    }

    public function orderHistory()
    {
        $userId = auth()->user()->id;

        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.user_id', $userId)
            ->select('orders.*', 'products.name as product_name', 'products.image_path as product_image', 'products.slug as product_slug', 'products.price as product_price')
            ->orderBy('created_at', 'DESC')
            ->get();
        
        return view('product.orderhistory')->with('orders', $orders);
    }

    public function search(Request $request)
    {
        $search_text = $request->search;
        // $products = Product::where('name', 'LIKE', '%' . $search_text . '%')->get();
        $products = DB::table('products')
            ->where('products.name', 'LIKE', '%' . $search_text . '%')
            ->orWhere('products.category', 'LIKE', '%' . $search_text . '%')
            ->get();

        return view('product.search', compact('products', 'search_text'));
    }

}