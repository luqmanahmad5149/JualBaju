@extends('layouts.app')

@section('content')
    @if (session()->has('message'))
        <div id="message_visibility" class="m-10 text-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Hey!</strong>
            <span class="block sm:inline">{{ session()->get('message') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <a href="#" class="fa fa-times" id="close"></a>
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
                            <div id="websiteImage" class="p-10 flex justify-center items-center">
                                <img src="img/father-promo.jpg" class="w-3/4 rounded-xl" />
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
                            <div id="websiteImage" class="p-10 flex justify-center items-center">
                                <img src="img/woman-promo.jpg" class="w-3/4 rounded-xl" />
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
                            <div id="websiteImage" class="p-10 flex justify-center items-center">
                                <img src="img/christmas-promo.jpg" class="w-3/4 rounded-xl" />
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
    <div id="product_data" class="mx-9">
        @include('product.pagination_data')
    </div>
@endsection
