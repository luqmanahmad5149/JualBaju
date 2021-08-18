@extends('layouts.app')

@section('content')
    <div id="delete-modal" hidden>
        <div class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                <!--content-->
                <div>
                    <!--body-->
                    <div class="text-center p-5 flex-auto justify-center">
                        <h2 class="text-xl font-bold py-4 ">Are you sure?</h3>
                        <p class="text-sm text-gray-500 px-8">Do you really want to delete this item? This process cannot be undone</p>    
                    </div>
                    <!--footer-->
                    <div class="p-3 mt-2 text-center space-x-13 flex flex-row justify-center items-center">
                        <button id="close-delete-modal" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100 w-32">
                            Cancel
                        </button>
                        <form 
                        action="/product/{{ $product->id }}"
                        method="POST">
                        @csrf
                        @method('delete')
                            <button class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600 w-32">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('message'))
    <div id="session_message" class="m-10 text-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Hey! </strong>
        <span class="block sm:inline">{{ session()->get('message') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <a href="#" class="fa fa-times" id="close"></a>
    </div> 
    @endif
    <div class="w-4/5 m-auto text-left">
        <div class="py-10">
            <h2 class="text-5xl capitalize font-bold text-gray-700 flex justify-center">
                {{ $product->name }}
            </h2>
        </div>
    </div>
    <div class="sm:grid grid-cols-2 gap-15 w-4/5 mx-auto py-5">
        <div class="flex justify-center bg-gray-50 border border-opacity-75 border-gray-300">
            <img src="/images/{{ $product->image_path }}" alt="" class="w-96 h-96 object-scale-down object-center">
        </div>
        <div>
            @if (isset(Auth::user()->id) && Auth::user()->id == $product->user_id)
                <span class="float-right">
                    <a 
                        href="/product/{{ $product->slug }}/edit"
                        class="text-gray-500 italic hover:text-gray-900 pb-1 text-2xl border-b-2 ml-8">
                        Edit
                    </a>
                </span>
                <span class="float-right">
                    <button 
                        id="open-delete-modal"
                        class="text-gray-500 italic hover:text-gray-900 pb-1 text-2xl border-b-2 ml-8">
                        Delete
                    </button>
                </span>
            @endif
            <h3 class="font-bold text-gray-700 pt-9 pb-4 text-4xl">
                RM {{ $product->price }}
            </h3>
            <h4 class="pb-4 pt-6 text-2xl font-bold capitalize">
                Description: <span class="font-normal leading-relaxed">{{ $product->description }}</span>
            </h4>
            <h4 class="capitalize pb-6 pt-4 text-2xl font-bold">
                Category: <span class="font-normal leading-relaxed">{{ $product->category }}</span>
            </h4>
            <div class="flex space-x-1/4">
                <h4 class="capitalize pb-6 pt-4 text-2xl font-bold">
                    Quantity: <span class="font-normal leading-relaxed">{{ $product->quantity }}</span>
                </h4>
                <h4 class="capitalize pb-6 pt-4 text-2xl font-bold">
                    Size: <span class="font-normal leading-relaxed">{{ $product->size }}</span>
                </h4>
            </div>
                @if ($product->quantity <= 0)
                    <h2 class="capitalize pb-6 pt-4 text-2xl font-bold text-red-800">
                        Product Out of Stock!
                    </h2>
                @else
                    <form action="/add_to_cart" method="POST">
                        <div class="flex space-x-5 items-center my-3">
                            <h4 class="capitalize pb-6 pt-4 text-xl">
                                Pick your quantity:
                            </h4>
                            <select name="quantity" id="quantity" class="apperance none w-1/6 h-10 bg-gray-50 border border-gray-700 text-gray-700 rounded leading-tight px-1">
                                @for ($i = 0; $i <= $product->quantity; $i++)
                                    <option value="{{ $i }}" {{ $i == 1 ? 'selected' : '' }} >{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="sm:grid grid-cols-2 gap-15 py-5 px-5">
                            <span>    
                        @csrf
                        <input 
                        type="hidden"
                        name="product_id"
                        value="{{ $product->id }}">
                        <button
                            class="bg-blue-500 text-gray-100 text-2xl py-4 px-8 font-bold hover:shadow-lg hover:bg-blue-700 text-center">
                            Add to Cart
                        </button>
                    </form>
                    {{-- <a 
                        href=""
                        class="bg-blue-500 text-gray-100 text-2xl py-4 px-8 font-bold hover:shadow-lg hover:bg-blue-700 text-center">
                        Add to Cart
                    </a> --}}
                    </span>
                    <span>
                        <form action="/add_to_cart" method="POST">
                            @csrf
                            <input 
                            type="hidden"
                            name="product_id"
                            value="{{ $product->id }}">
                            <button
                                class="bg-green-500 text-gray-100 text-2xl py-4 px-8 font-bold hover:shadow-lg hover:bg-green-700 text-center">
                                Buy Now
                            </button>
                        </form>
                        {{-- <a 
                            href=""
                            class="bg-blue-500 text-gray-100 text-2xl py-4 px-8 font-bold hover:shadow-lg hover:bg-blue-700 text-center">
                            Add to Cart
                        </a> --}}
                    </span>
                @endif
            </div>
        </div>
    </div>
@endsection