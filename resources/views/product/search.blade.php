@extends('layouts.app')

@section('content')
    <div class="border-b border-gray-200 mt-4 pb-4 w-4/5 m-auto pt-10 flex justify-start">
        <h4 class="text-3xl font-bold ">Search result for {{ $search_text ?? 'all products' }}</h4>
    </div>
    <div class="mt-8">
        <div class="w-4/5 m-auto pt-3 grid grid-cols-4 gap-13">
            @if ($products->isNotEmpty())
                @foreach ($products as $product )
                    <div class="card shadow-md hover:shadow-lg">
                        <a href="product/{{ $product->slug }}">
                            <div class="bg-gray-50">
                                <img 
                                    src="/images/{{ $product->image_path }}" 
                                    alt=""
                                    class="w-full h-32 sm:h-48 object-scale-down object-center">
                            </div>
                            <div class="m-4 flex flex-col justify-center items-center">
                                <span class="text-1xl capitalize">{{ $product->name }}<span>
                                    @if (isset(Auth::user()->id) && $product->user_id == Auth::user()->id)
                                        <i class="fas fa-check text-gray-700 ml-1"></i>
                                    @endif
                                </span></span>
                                <span class="block font-bold text-gray-700 text-sm pt-2">RM {{ $product->price }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="w-full h-60 flex justify-center">
                    <h3 class="text-gray-700 text-lg">Item not available</h3>
                </div>
            @endif
        </div>
    </div>
@endsection