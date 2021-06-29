@extends('layouts.app')

@section('content')
    <div class="border-b border-gray-200 mt-4 pb-4 w-4/5 m-auto pt-10 flex justify-center">
        <h4 class="text-3xl font-bold ">Shopping Cart</h4>
        @if ($products->isNotEmpty())
            <a 
                href="/ordernow" 
                class="uppercase text-gray-100 text-s font-extrabold py-3 px-7 rounded-2xl ml-4 shadow-lg bg-yellow-500 hover:bg-yellow-400">
                Grab All
            </a>
        @endif
    </div>
    <div class="mt-8">
        <div class="flex flex-col items-center justify-center w-3/5 m-auto">
            @if ($products->isNotEmpty())
                @foreach ($products as $product )
                    <div class="card shadow-md hover:shadow-lg w-2/5 mb-10">
                        <a href="product/{{ $product->slug }}">
                            <div class="bg-gray-50 flex justify-center">
                                <img 
                                    src="/images/{{ $product->image_path }}" 
                                    alt=""
                                    class="w-2/5 h-32 sm:h-48 object-scale-down object-center">
                            </div>
                            <div class="m-4 p-2">
                                <span class="text-1xl capitalize">{{ $product->name }}</span>
                                <span class="float-right">
                                    <form 
                                        action="/removecart/{{ $product->cart_id }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button
                                            class="uppercase text-gray-100 text-xs rounded-2xl ml-4 bg-red-500 hover:bg-red-600 p-3">
                                            Remove item
                                        </button>
                                    </form>
                                </span>
                                <span class="block font-bold text-gray-700 text-sm pt-2">RM {{ $product->price }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach  
            @else
                    <div class="w-full h-60 flex justify-center">
                        <h3 class="text-gray-700 text-lg">No Item in Cart</h3>
                    </div>
            @endif
        </div>
    </div>
@endsection