<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Products;
use Validator;
use Stripe;

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
        $userId = auth()->user()->id;

        $user = User::where('id', $userId)->first();

        return view('product.create', compact('user', $user));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'size' => 'required',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:5048'
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        } else {
            $newImageName = uniqid() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
    
            $product = Product::create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'category' => $request->input('category'),
                'description' => $request->input('description'),
                'image_path' => $newImageName,
                'user_id' => auth()->user()->id,
                'slug' => SlugService::createSlug(Product::class, 'slug', $request->name),
            ]);
    
            $product_id = $product->id;
    
            $query = DB::table('quantities')->insert([
                'product_id' => $product_id,
                'size' => $request->input('size'),
                'quantity' => $request->input('quantity'),
            ]);
    
            if($query){
                return response()->json(['status'=>1, 'msg'=> 'Your product has been successfully added!']);
            }
        }

    }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'price' => 'required|numeric',
    //         'quantity' => 'required|numeric',
    //         'size' => 'required',
    //         'category' => 'required',
    //         'description' => 'required',
    //         'image' => 'required|mimes:png,jpg,jpeg|max:5048',
    //     ]);

    //     $newImageName = uniqid() . '-' . $request->name . '.' . $request->image->extension();
    //     $request->image->move(public_path('images'), $newImageName);

    //     $product = Product::create([
    //         'name' => $request->input('name'),
    //         'price' => $request->input('price'),
    //         'category' => $request->input('category'),
    //         'description' => $request->input('description'),
    //         'image_path' => $newImageName,
    //         'user_id' => auth()->user()->id,
    //         'slug' => SlugService::createSlug(Product::class, 'slug', $request->name),
    //     ]);

    //     $product_id = $product->id;

    //     DB::table('quantities')->insert([
    //         'product_id' => $product_id,
    //         'size' => $request->input('size'),
    //         'quantity' => $request->input('quantity'),
    //     ]);

    //     return redirect('/product')
    //         ->with('message', 'Your product has been added!');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = DB::table('products')
                    ->join('quantities', 'products.id', '=', 'quantities.product_id')
                    ->select('products.*', 'quantities.size', 'quantities.quantity')
                    ->where('products.slug', '=', $slug)
                    ->first();

        return view('product.show')
            ->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = DB::table('products')
        ->join('quantities', 'products.id', '=', 'quantities.product_id')
        ->select('products.*', 'quantities.size', 'quantities.quantity')
        ->where('products.slug', '=', $slug)
        ->first();

        $userId = auth()->user()->id;

        $user = User::where('id', $userId)->first();

        return view('product.edit', compact('product', 'user'));
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
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'size' => 'required',
            'category' => 'required',
            'description' => 'required'
        ]);

        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        } else {
            Product::where('slug', $slug)
                ->update([
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'category' => $request->input('category'),
                    'description' => $request->input('description'),
                    'user_id' => auth()->user()->id,
                    'slug' => SlugService::createSlug(Product::class, 'slug', $request->name),
                ]);
    
            $product_id = $request->input('product_id');
    
            DB::table('quantities')
                ->where('product_id', $product_id)
                ->update([
                    'size' => $request->input('size'),
                    'quantity' => $request->input('quantity'),
                ]);
    
            return response()->json(['status'=>1, 'msg'=> 'Your product has been successfully updated!']);

        }

    }
    // public function update(Request $request, $slug)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'price' => 'required',
    //         'category' => 'required',
    //         'description' => 'required',
    //     ]);

    //     Product::where('slug', $slug)
    //         ->update([
    //             'name' => $request->input('name'),
    //             'price' => $request->input('price'),
    //             'category' => $request->input('category'),
    //             'description' => $request->input('description'),
    //             'user_id' => auth()->user()->id,
    //             'slug' => SlugService::createSlug(Product::class, 'slug', $request->name),
    //         ]);

    //     $product_id = $request->input('product_id');

    //     DB::table('quantities')
    //         ->where('product_id', $product_id)
    //         ->update([
    //             'size' => $request->input('size'),
    //             'quantity' => $request->input('quantity'),
    //         ]);

    //     return redirect('/product')->with('message', 'Your product has been updated!');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $product = Product::where('id', $id);
        // $product->delete();

        $product = DB::table('products')
            ->where('id', $id)
            ->first();

        $imagePath = "images/".$product->image_path;

        if(file_exists($imagePath)){
            unlink($imagePath);
        }

        $product = Product::where('id', $id)->delete();

        return redirect('/')->with('message', 'Your product has been successfully deleted!');        
    }

    public function addToCart(Request $request)
    {
        if (auth()->user())
        {
            $product = DB::table('quantities')->select('quantity')->where('product_id', $request->input('product_id'))->first();

            if($request->input('quantity') == 0) {
                return redirect()
                    ->back()
                    ->with('message', "Don't forget to state how many you want to buy.");
            }   else {
                if($product->quantity >= 1){
                    Cart::create([
                        'product_id' => $request->input('product_id'),
                        'user_id' => auth()->user()->id,
                        'quantity' => $request->input('quantity'),
                    ]);
                    return redirect()
                        ->back()
                        ->with('message', 'Your product has been successfully added to cart!');
                } else{
                    return redirect()
                    ->back()
                    ->with('message', 'Product is out of stock');
                }
            }

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
            ->join('quantities', 'carts.product_id', '=', 'quantities.product_id')
            ->where('carts.user_id', $userId)
            ->select('products.*','carts.id as cart_id', 'carts.quantity as cart_quantity', 'quantities.size as product_size' )
            ->get();

        return view('product.cartlist')->with('products', $products);
    }

    public function getCartlist()
    {
        $userId = auth()->user()->id;

        $products = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->join('quantities', 'carts.product_id', '=', 'quantities.product_id')
            ->where('carts.user_id', $userId)
            ->select('products.*','carts.id as cart_id', 'carts.quantity as cart_quantity', 'quantities.size as product_size' )
            ->get();

        return view('product.cartlist_data', compact('products'))->render();
    }

    public function removeCart($id)
    {
        $cart = Cart::where('id', $id);
        $cart->delete();
        // return redirect('/cartlist');     
    }

    public function removeCart1($id)
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
            ->sum(DB::raw('products.price * carts.quantity'));
        
        $user = DB::table('users')
            ->where('id', $userId)
            ->first();

        $products = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->join('quantities', 'carts.product_id', '=', 'quantities.product_id')
            ->where('carts.user_id', $userId)
            ->select('carts.*', 'products.name', 'products.price', 'quantities.size', DB::raw('products.price * carts.quantity as total_price'))
            ->get();

        return view('product.ordernow', compact('total', 'user', 'products'));
    }

    public function orderPlace(Request $request)
    {
        $userId = auth()->user()->id;

        $user = DB::table('users')
            ->where('id', $userId)
            ->first(); 

        $allCart = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.price', DB::raw('products.price * carts.quantity as total_price'))
            ->get();

        $stripe = Stripe::make(env('STRIPE_KEY'));

        try{
            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => $request->input('card_number'),
                    'exp_month' => $request->input('exp_month'),
                    'exp_year' => $request->input('exp_year'),
                    'cvc' => $request->input('cvc'),
                ]
            ]);     

            if(!isset($token['id'])){
                return redirect('/ordernow')->with('message', 'Stripe token was not generated correctly.');
            }

            $customer = $stripe->customers()->create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->contact,
                'address' => [
                    'line1' => '441 1/1 taman damai',
                    'postal_code' => '09400',
                    'city' => 'Padang Serai',
                    'state' => 'Kedah',
                    'country' => 'Malaysia',
                ],
                'shipping' => [
                    'name' => $user->name,
                    'address' => [
                        'line1' => '441 1/1 taman damai',
                        'postal_code' => '09400',
                        'city' => 'Padang Serai',
                        'state' => 'Kedah',
                        'country' => 'Malaysia',
                    ]
                ],
                'source' => $token['id'],
            ]); 

            $charge = $stripe->charges()->create([
                'customer' => $customer['id'],
                'currency' => 'MYR',
                'amount' => $request->input('total_payment'),
                'description' => 'Payment for order'
            ]);

            if($charge['status'] == 'succeeded')
            {
                foreach( $allCart as $cart)
                {
                    $order = new Order;
                    $order->product_id = $cart->product_id;
                    $order->user_id = $userId;
                    $order->address = $request->input('address');
                    $order->total_payment = $cart->total_price;
                    $order->quantity = $cart->quantity;
                    $order->payment_method = $request->input('payment');
                    $order->payment_status = 'Succesful';
                    $order->status = 'On Delivery';
                    $order->save();
                    Cart::where('id', $cart->id)->delete();

                    DB::table('quantities')
                        ->where('product_id', $cart->product_id)
                        ->decrement('quantity', $cart->quantity);
                }
            }
            else
            {
                return redirect('/ordernow')->with('message', 'Transaction error.');
            }
        } catch (Exception $e){
            return redirect('/ordernow')->with('message', $e->getMessage());
        }

        return redirect('/product')->with('message', 'Order has been successfully placed!');

        // foreach( $allCart as $cart)
        // {
        //     $order = new Order;
        //     $order->product_id = $cart->product_id;
        //     $order->user_id = $userId;
        //     $order->address = $request->input('address');
        //     $order->total_payment = $cart->total_price;
        //     $order->quantity = $cart->quantity;
        //     $order->payment_method = $request->input('payment');
        //     $order->payment_status = 'Succesful';
        //     $order->status = 'On Delivery';
        //     $order->save();
        //     Cart::where('id', $cart->id)->delete();

        //     DB::table('quantities')
        //         ->where('product_id', $cart->product_id)
        //         ->decrement('quantity', $cart->quantity);
        // }

        // return redirect('/product')->with('message', 'Order has been successfully placed!');
    }

    public function orderHistory()
    {
        $userId = auth()->user()->id;

        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('quantities', 'orders.product_id', '=', 'quantities.product_id')
            ->where('orders.user_id', $userId)
            ->select('orders.*', 'products.name as product_name', 'products.image_path as product_image', 'products.slug as product_slug', 'products.price as product_price', 'quantities.size as product_size')
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