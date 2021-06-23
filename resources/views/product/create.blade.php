@extends('layouts.app')

@section('content')
    <div class="border-b border-gray-200 mt-4 pb-4 w-4/5 m-auto pt-10">
        <h4 class="text-3xl font-bold ">Sell Clothes</h4>
    </div>

    @if ($errors->any())
        <div class="w-4/5 m-auto p-3 text-center">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="w-4/5 m-auto pt-10">
        <form 
            action="/product"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="block mb-2">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-8">Clothes Name: </label>
                <input 
                    type="text" 
                    name="name" 
                    class="appearance-none w-1/2 h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
            </div>
            <div class="block mb-7">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-28">Price: </label>
                <input 
                    type="text" 
                    name="price" 
                    class="appearance-none w-1/2 h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
            </div>
            <div class="block mb-7">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold block pb-4">Category: </label>
                <select 
                    name="category" 
                    class="apperance none w-1/6 h-10 bg-gray-50 border border-gray-700 text-gray-700 rounded leading-tight px-4">
                    <option value="">Select Category</option>
                    <option value="swimming suit">Swimming suit</option>
                    <option value="airism">Airism</option>
                    <option value="suit">Suit</option>
                    <option value="trouser">Trouser</option>
                    <option value="t-shirt">T-shirt</option>
                    <option value="jeans">Jeans</option>
                </select>
            </div> 

            <div class="block mb-7">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-10 block pb-4">Description: </label>
                <textarea 
                    name="description" 
                    cols="50"
                    rows="6"
                    class="apperance none bg-gray-50 border border-gray-700 text-gray-700 rounded leading-tight py-3 px-4 mb-3"></textarea>
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
                type="submit"
                class="uppercase mt-10 shadow-lg bg-yellow-500 hover:bg-yellow-400 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-2xl">
                Submit Item
            </button>
        </form>
    </div>
@endsection