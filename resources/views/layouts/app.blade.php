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
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/css/themes/splide-skyblue.min.css">
    <link rel="stylesheet" href=" {{mix ('css/style.css')}}"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@2.4.21/dist/js/splide.min.js"></script>
    <!-- Styles -->
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
    <script>
        new Splide( '.splide', {
            type: 'loop',
            rewind : true,
            autoplay: true,
        } ).mount();
    </script>
    <script>
        $(document).ready(function(){
            $("#close").click(function(){
                $("#message_visibility").hide();
            });
            $("#close").click(function(){
                $("#session_message").hide();
            });

            $("#close-modal").click(function(){
                $("#popup_modal").hide();
            });

            $("#open-delete-modal").click(function(){
                $("#delete-modal").show();
            })

            $("#close-delete-modal").click(function(){
                $("#delete-modal").hide();
            })
            
            $(document).on('click', '[role="navigation"] a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                getMoreProducts(page);
            });

            function getMoreProducts(page){
                $.ajax({
                    type: "GET",
                    url: "{{ route('products.get-more-products') }}" + "?page=" + page,
                    success: function(data){
                        $('#product_data').html(data);
                    }
                });
            }
        });

        $(function(){
            $("#create_form").on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    url:$(this).attr('action'),
                    method:$(this).attr('method'),
                    data:new FormData(this),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.status == 0){
                            $.each(data.error, function(prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        } 
                        else {
                            $('#create_form')[0].reset();
                            $('#popup_modal').show()
                            $('#session_message').html(data.msg);
                        }
                    }
                });
            });
        });

        $(function(){
            $("#edit_form").on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    url:$(this).attr('action'),
                    method:$(this).attr('method'),
                    data:new FormData(this),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.status == 0){
                            $.each(data.error, function(prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        } 
                        else {
                            $('#popup_modal').show()
                            $('#session_message').html(data.msg);
                        }
                    }
                });
            });
        });

        function getCartList(){
                $.ajax({
                    type: "GET",
                    url: "{{ route('products.get-cartlist') }}",
                    success: function(data){
                        $('#cartlist_data').html(data);
                    }
                });
        }

        $(function(){
        $("#delete_form").on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url:$(this).attr('action'),
                method:$(this).attr('method'),
                data:new FormData(this),
                processData:false,
                dataType:'json',
                contentType:false
            });
        });
        });

        getCartList();
        
    </script>
</body>
</html>
