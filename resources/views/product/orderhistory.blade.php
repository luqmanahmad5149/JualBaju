@extends('layouts.app')

@section('content')
    <div class="border-b border-gray-200 mt-4 pb-4 w-4/5 m-auto pt-10 flex justify-center">
        <h4 class="text-3xl font-bold ">Orders List</h4>
    </div>
    <div class="mt-8">
        <div class="flex flex-col items-center justify-center w-3/5 m-auto">
            @if ($orders->isNotEmpty())
                @foreach ($orders as $order )
                    <div class="card shadow-md hover:shadow-lg w-2/5 mb-10">
                        <div class="bg-gray-400 flex justify-center p-3">
                            <h2 class="font-bold text-gray-700 text-xl">
                                {{ $order->status }}
                            </h2>
                        </div>
                        <a href="product/{{ $order->product_slug }}">
                            <div class="bg-gray-50 flex justify-center">
                                <img 
                                    src="/images/{{ $order->product_image }}" 
                                    alt=""
                                    class="w-2/5 h-32 sm:h-48 object-scale-down object-center">
                            </div>
                            <div class="m-4 p-2">
                                <span class="text-md capitalize">{{ $order->product_name }} ({{ $order->product_size }})</span>
                                <span class="block font-bold text-gray-700 text-sm pt-2">RM {{ number_format($order->total_payment, 2, '.', '') }}</span>
                                <span class="block text-md capitalize pt-2">Items Quantity: <span class="font-bold text-md">{{ $order->quantity }}</span></span>
                                <span class="block text-md capitalize pt-2">Payment Status: <span class="font-bold text-md">{{ $order->payment_status }}</span></span>
                                <span class="block text-md capitalize pt-2">Purchase On: <span class="font-bold text-md">{{ date('jS M Y', strtotime($order->created_at)) }}</span></span>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="w-full h-60 flex justify-center">
                    <h3 class="text-gray-700 text-lg">No Order History</h3>
                </div>
            @endif
        </div> 
    </div>
@endsection