@extends('layouts.app')

@section('content')
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
            <a 
                href="javascript:history.back()"
                class="text-gray-500 italic hover:text-gray-900 pb-1 text-2xl border-b-2">
                Go Back
            </a>
            @if (isset(Auth::user()->id) && Auth::user()->id == $product->user_id)
                <span class="float-right">
                    <a 
                        href="/product/{{ $product->slug }}/edit"
                        class="text-gray-500 italic hover:text-gray-900 pb-1 text-2xl border-b-2 ml-8">
                        Edit
                    </a>
                </span>
                <span class="float-right">
                    <form 
                        action="/product/{{ $product->slug }}"
                        method="POST">
                        @csrf
                        @method('delete')
                        <button 
                            class="text-gray-500 italic hover:text-gray-900 pb-1 text-2xl border-b-2 ml-8">
                            Delete
                        </button>
                    </form>
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
            <div class="sm:grid grid-cols-2 gap-15 py-5 px-5">
                <span>
                    <form action="/add_to_cart" method="POST">
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
            </div>
        </div>
    </div>
@endsection