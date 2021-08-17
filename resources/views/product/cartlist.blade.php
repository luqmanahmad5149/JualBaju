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
    <div class="mt-8" id="cartlist_data">
        @include('product.cartlist_data')
    </div>
@endsection