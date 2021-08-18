@extends('layouts.app')

@section('content')

    <div id="popup_modal" hidden>
        <div class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
            <div class="max-w-md p-5 py-7 relative rounded-xl shadow-lg bg-white ">
                <!--content-->
                <div>
                    <!--body-->
                    <div class="text-center p-5 flex-auto justify-center">
                        <h2 class="text-xl font-bold py-4 ">Hey, {{ $user->name }}!</h3>
                        <p class="text-sm text-gray-500 px-8" id="session_message"></p>    
                    </div>
                    <!--footer-->
                    <div class="p-3 mt-2 text-center space-x-4 md:block">
                        <a href="/product" id="close-modal" class="mx-4 bg-white px-6 py-3 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                            Okay
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div id="message_visibility" class="m-10 text-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" hidden>
        <strong class="font-bold">Hey!</strong>
        <span id="session_message" class="block sm:inline"></span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <a href="#" class="fa fa-times" id="close"></a>
    </div>  --}}

    <div class="border-b border-gray-200 mt-4 pb-4 w-4/5 m-auto pt-10">
        <h4 class="text-3xl font-bold ">Edit Item</h4>
    </div>

    {{-- @if ($errors->any())
        <div class="w-4/5 m-auto text-center">
            <ul class="grid grid-cols-4 gap-x-2">
                @foreach ($errors->all() as $error)
                    <li class="text-gray-50 bg-red-700 rounded-2xl py-4 mt-5">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="w-4/5 m-auto pt-10">
        <form 
            id="edit_form"
            action="/product/edit/{{ $product->slug }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="block mb-2">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-8">Clothes Name: </label>
                <input 
                    id="name"
                    type="text" 
                    name="name"
                    value="{{ $product->name }}" 
                    class="appearance-none w-1/2 h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
                <input type="hidden" value="{{ $product->id }}" name="product_id">
                <span class="text-red-800 error-text name_error ml-3"></span>
            </div>
            <div class="block mb-2">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-28">Price: </label>
                <input 
                    id="price"
                    type="text" 
                    name="price" 
                    value="{{ $product->price }}"
                    class="appearance-none w-1/2 h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
                <span class="text-red-800 error-text price_error ml-3"></span>
            </div>
            <div class="block mb-5">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-16">Quantity: </label>
                <input 
                    id="quantity"
                    type="text" 
                    name="quantity" 
                    value="{{ $product->quantity }}"
                    class="appearance-none w-1/5 h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3 ml-2">
                <span class="text-red-800 error-text quantity_error ml-3"></span>
            </div>
            <div class="block mb-7">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold block pb-4">Size: </label>
                <select 
                    id="size"
                    name="size" 
                    class="apperance none w-1/6 h-10 bg-gray-50 border border-gray-700 text-gray-700 rounded leading-tight px-4">
                    <option value="S" {{ $product->size == "S" ? "selected" : ""  }}>S</option>
                    <option value="M" {{ $product->size == "M" ? "selected" : ""  }}>M</option>
                    <option value="L" {{ $product->size == "L" ? "selected" : ""  }}>L</option>
                    <option value="XL" {{ $product->size == "XL" ? "selected" : ""  }}>XL</option>
                </select>
                <span class="text-red-800 error-text size_error ml-3"></span>
            </div> 
            <div class="block mb-7">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold block pb-4">Category: </label>
                <select 
                    id="category"
                    name="category" 
                    class="apperance none w-1/6 h-10 bg-gray-50 border border-gray-700 text-gray-700 rounded leading-tight px-4">
                    <option value="swimming suit" {{ $product->category == "swimming suit" ? "selected" : ""  }}>Swimming Suit</option>
                    <option value="airism" {{ $product->category == "airism" ? "selected" : ""  }}>Airism</option>
                    <option value="suit" {{ $product->category == "suit" ? "selected" : ""  }}>Suit</option>
                    <option value="trouser" {{ $product->category == "trouser" ? "selected" : ""  }}>Trouser</option>
                    <option value="t-shirt" {{ $product->category == "t-shirt" ? "selected" : ""  }}>T-shirt</option>
                    <option value="jeans" {{ $product->category == "jeans" ? "selected" : ""  }}>Jeans</option>
                </select>
                <span class="text-red-800 error-text category_error ml-3"></span>
            </div> 

            <div class="block mb-7">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-10 block pb-4">Description: </label>
                <div class="flex flex-row items-center">
                    <textarea 
                        id="description"
                        name="description" 
                        cols="50"
                        rows="6"
                        class="apperance none bg-gray-50 border border-gray-700 text-gray-700 rounded leading-tight py-3 px-4 mb-3 text-area">{{ $product->description }}</textarea>
                    <span class="text-red-800 error-text description_error ml-4"></span>
                </div>
            </div>  

            <div class="bg-grey-lighter flex flex-row items-center">
                <label class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
                    <span class="mt-2 text-base leading-normal">
                        Select an image
                    </span>
                    <input 
                        id="image"
                        type="file" 
                        name="image" 
                        class="hidden">
                </label>
                <div class="ml-4">
                    <span class="text-red-800 error-text image_error"></span>
                </div>
            </div>

            <button 
                id="ajax-submit"
                type="submit"
                class="uppercase mt-10 shadow-lg bg-yellow-500 hover:bg-yellow-400 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-2xl">
                Submit Item
            </button>
        </form>
    </div>
    {{-- <div class="w-4/5 m-auto pt-10">
        <form 
            action="/product/{{ $product->slug }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="block mb-2">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-8">Clothes Name: </label>
                <input 
                    type="text" 
                    name="name"
                    value="{{ old('name') ?? $product->name }}"
                    class="appearance-none w-1/2 h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
                <input type="hidden" value="{{ $product->id }}" name="product_id">
            </div>
            <div class="block mb-2">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-28">Price: </label>
                <input 
                    type="text" 
                    name="price"
                    value="{{ old('price') ?? $product->price }}"
                    class="appearance-none w-1/2 h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
            </div>
            <div class="block mb-5">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-16">Quantity: </label>
                <input 
                    id="quantity"
                    type="text" 
                    name="quantity" 
                    class="appearance-none w-1/5 h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3 ml-2"
                    value="{{ old('quantity') ?? $product->quantity }}">
            </div>
            <div class="block mb-7">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold block pb-4">Size: </label>
                <select 
                    id="size"
                    name="size" 
                    class="apperance none w-1/6 h-10 bg-gray-50 border border-gray-700 text-gray-700 rounded leading-tight px-4">
                    <option value="{{ $product->size }}">{{ $product->size }}</option>
                    <option value="S" {{ old('size') == "S" ? 'selected' : '' }}>S</option>
                    <option value="M" {{ old('size') == "M" ? 'selected' : '' }}>M</option>
                    <option value="L" {{ old('size') == "L" ? 'selected' : '' }}>L</option>
                    <option value="XL" {{ old('size') == "XL" ? 'selected' : '' }}>XL</option>
                </select>
            </div> 
            <div class="block mb-7">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold block pb-4">Category: </label>
                <select 
                    name="category"
                    class="apperance none w-1/6 h-10 bg-gray-50 border border-gray-700 text-gray-700 rounded leading-tight px-4 capitalize">
                    <option value="{{ $product->category }}">{{ $product->category }}</option>
                    <option value="swimming suit" {{ old('swimming suit') == "swimming suit" ? 'selected' : '' }}>Swimming suit</option>
                    <option value="airism" {{ old('airism') == "airism" ? 'selected' : '' }}>Airism</option>
                    <option value="suit" {{ old('suit') == "suit" ? 'selected' : '' }}>Suit</option>
                    <option value="trouser" {{ old('trouser') == "trouser" ? 'selected' : '' }}>Trouser</option>
                    <option value="t-shirt" {{ old('t-shirt') == "t-shirt" ? 'selected' : '' }}>T-shirt</option>
                    <option value="jeans" {{ old('jeans') == "jeans" ? 'selected' : '' }}>Jeans</option>
                </select>
            </div> 

            <div class="block mb-7">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-10 block pb-4">Description: </label>
                <textarea 
                    name="description" 
                    cols="50"
                    rows="6"
                    class="text-area apperance none bg-gray-50 border border-gray-700 text-gray-700 rounded leading-tight py-3 px-4 mb-3">{{ old('description') ?? $product->description }}</textarea>
            </div>  

            <div class="bg-grey-lighter">
                <label class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
                    <span class="mt-2 text-base leading-normal">
                        Select an image
                    </span>
                    <input 
                        type="file" 
                        name="image" 
                        class="hidden">
                </label>
            </div>

            <button 
                id="ajax-submit"
                type="submit"
                class="uppercase mt-10 shadow-lg bg-yellow-500 hover:bg-yellow-400 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-2xl">
                Submit Item
            </button>
        </form>
    </div> --}}
@endsection