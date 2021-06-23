@extends('layouts.app')

@section('content')
    @if (session()->has('message'))
    <div class="w-full mt-10 p-1 text-center">
        <p class="mb-4 text-gray-50 bg-green-500 rounded-md py-3">
            {{ session()->get('message') }}
        </p>
    </div>
    @endif
    <div class="m-auto border-b border-gray-200 mt-12 flex justify-center items-center pb-4 ">
        <h4 class="text-3xl font-bold ">Trending Items</h4>
        @if (Auth::check())
            <a 
                href="/product/create" 
                class="uppercase text-gray-100 text-s font-extrabold py-3 px-7 rounded-2xl ml-4 shadow-lg bg-yellow-500 hover:bg-yellow-400">
                Sell
            </a>
        @endif
    </div>
    <div class="mt-8">
        <div class="p-10 grid grid-cols-4 gap-10">
            @foreach ($products as $product )
                <div class="card shadow-md hover:shadow-lg">
                    <a href="product/{{ $product->slug }}">
                        <div class="bg-gray-50">
                            <img 
                                src="/images/{{ $product->image_path }}" 
                                alt=""
                                class="w-full h-32 sm:h-48 object-scale-down object-center">
                        </div>
                        <div class="m-4">
                            <span class="text-1xl capitalize">{{ $product->name }}</span>
                            <span class="block font-bold text-gray-700 text-sm pt-2">RM {{ $product->price }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="px-15">
            {{ $products->links() }}
        </div>
    </div>
@endsection