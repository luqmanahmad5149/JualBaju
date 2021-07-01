@extends('layouts.app')

@section('content')
    @if (session()->has('message'))
    <div class="w-full mt-10 p-1 text-center">
        <p class="mb-4 text-gray-50 bg-green-500 rounded-md py-3">
            {{ session()->get('message') }}
        </p>
    </div>
    @endif
    <div class="my-15 mx-20 bg-white shadow-md">
        <div class="splide m-6">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <div class="grid md:grid-cols-2 grid-cols-1 place-items-center">
                            <div id="websiteDescription" class="flex flex-col items-center justify-center align-middle p-3 md:ml-20 ml-1 text-center">
                                <h1 class="text-3xl font-bold">Special Promotion</h1>
                                <p class="mt-5 text-md">Lorem ipsum, dolor fugit quo eligendi adipisci sit amet consectetur adipisicing elit. Ex enim adipisci fugit! Officia est assumenda natus voluptate, fugit quo eligendi adipisci et debitis repudiandae non quis sunt inventore esse cum?</p>
                                <a 
                                    href="#" 
                                    class="uppercase mt-6 text-gray-100 text-s font-extrabold w-1/4 p-3 rounded-2xl shadow-lg bg-blue-600 hover:bg-blue-400">
                                    View More
                                </a>
                            </div>
                            <div id="websiteImage" class="p-3 flex justify-center items-center">
                                <img src="img/father-promo.jpg" class="w-3/4 border-2 rounded-xl" />
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="grid md:grid-cols-2 grid-cols-1 place-items-center">
                            <div id="websiteDescription" class="flex flex-col items-center justify-center align-middle p-3 md:ml-20 ml-1 text-center">
                                <h1 class="text-3xl font-bold">Special Promotion</h1>
                                <p class="mt-5 text-md">Lorem ipsum, dolor fugit quo eligendi adipisci sit amet consectetur adipisicing elit. Ex enim adipisci fugit! Officia est assumenda natus voluptate, fugit quo eligendi adipisci et debitis repudiandae non quis sunt inventore esse cum?</p>
                                <a 
                                    href="#" 
                                    class="uppercase mt-6 text-gray-100 text-s font-extrabold w-1/4 p-3 rounded-2xl shadow-lg bg-blue-600 hover:bg-blue-400">
                                    View More
                                </a>
                            </div>
                            <div id="websiteImage" class="p-3 flex justify-center items-center">
                                <img src="img/woman-promo.jpg" class="w-3/4 border-2 rounded-xl" />
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="grid md:grid-cols-2 grid-cols-1 place-items-center">
                            <div id="websiteDescription" class="flex flex-col items-center justify-center align-middle p-3 md:ml-20 ml-1 text-center">
                                <h1 class="text-3xl font-bold">Special Promotion</h1>
                                <p class="mt-5 text-md">Lorem ipsum, dolor fugit quo eligendi adipisci sit amet consectetur adipisicing elit. Ex enim adipisci fugit! Officia est assumenda natus voluptate, fugit quo eligendi adipisci et debitis repudiandae non quis sunt inventore esse cum?</p>
                                <a 
                                    href="#" 
                                    class="uppercase mt-6 text-gray-100 text-s font-extrabold w-1/4 p-3 rounded-2xl shadow-lg bg-blue-600 hover:bg-blue-400">
                                    View More
                                </a>
                            </div>
                            <div id="websiteImage" class="p-3 flex justify-center items-center">
                                <img src="img/christmas-promo.jpg" class="w-3/4 border-2 rounded-xl" />
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="m-auto mt-12 mb-4 flex justify-center items-center">
        <h4 class="text-3xl font-bold ">Trending Items</h4>
        @if (Auth::check())
            <a 
                href="/product/create" 
                class="uppercase text-gray-100 text-s font-extrabold py-3 px-7 rounded-2xl ml-4 shadow-lg bg-yellow-500 hover:bg-yellow-400">
                Sell
            </a>
        @endif
    </div>
    <div>
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
        </div>
        {{-- <div class="px-15">
            {{ $products->links() }}
        </div> --}}
    </div>
@endsection
