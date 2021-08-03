<?php 
    use App\Http\Controllers\ProductsController;
    $total = 0;

    if(Auth::user())
    {
        $total = ProductsController::cartItem();
    }
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Jual Baju | Simple & Easy</title>
    <link rel="shortcut icon" type="image/png" href="/img/logo3.png">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/css/themes/splide-skyblue.min.css">
    <link rel="stylesheet" href=" {{mix ('css/style.css')}}"> 
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-gray-800 py-6 sticky top-0 z-50"">
            <div class="container mx-auto flex items-center px-6">
                <div class="w-1/4">
                    <a href="{{ url('/product') }}" class="text-4xl font-semibold text-gray-100 no-underline">
                        JualBaju
                    </a>
                </div>
                <div class="w-3/4">
                    <div class="flex w-full items-center justify-end">
                        <form action="/search" method="GET">
                            <div class="shadow flex">
                                <input class="w-96 p-2" name="search" type="search" placeholder="Search for your item">
                                <button type="submit" class="bg-white w-auto flex justify-end items-center text-blue-500 p-2 hover:text-blue-400">
                                    <i class="fas fa-search bg-white mx-3"></i>
                                </button>
                            </div>
                        </form>
                        <div class="ml-10">
                            <nav class="space-x-4 text-gray-300 text-sm sm:text-base">
                                <a class="no-underline hover:underline" href="/">Home</a>
            
                                @guest
                                    <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    @if (Route::has('register'))
                                        <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    @endif
                                @else
                                    <a class="no-underline hover:underline" href="/profile"><span>{{ Auth::user()->name }}</span></a>   
                                    <a class="no-underline hover:underline" href="/cartlist">Cart({{ $total }})</a>
                                    <a class="no-underline hover:underline" href="/orderhistory">My Orders</a>
                                    <a href="{{ route('logout') }}"
                                       class="no-underline hover:underline"
                                       onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        {{ csrf_field() }}
                                    </form>
                                @endguest
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div>
            @yield('content')
        </div>

        <div>
            @include('layouts.footer')
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/js/splide.min.js"></script>
    <script>
        new Splide( '.splide', {
            type: 'loop',
            rewind : true,
            autoplay: true,
        } ).mount();
    </script>
    <script>
        $("document").ready(function(){
            $("#close").click(function(){
                $("#session_message").hide();
            });
        });
    </script>
</body>
</html>
