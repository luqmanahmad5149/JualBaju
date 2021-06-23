@extends('layouts.app')

@section('content')
    <div class="border-b border-gray-200 mt-4 pb-4 w-4/5 m-auto pt-10">
        <h4 class="text-3xl font-bold ">Update Profile</h4>
    </div>

    <div class="w-4/5 m-auto pt-10">
        <form 
            action="/profile/update/{{ $user->id }}"
            method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="block mb-2">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-8">Name: </label>
                <input 
                    type="text" 
                    name="name"
                    value="{{ $user->name }}"
                    class="appearance-none w-1/2 h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
            </div>

            <div class="block mb-7">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-8">Email: </label>
                <input 
                    type="text" 
                    name="email"
                    value="{{ $user->email }}"
                    class="appearance-none w-1/2 h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
            </div>

            <div class="block mb-1">
                <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-10 block pb-4">Address: </label>
                <textarea 
                    name="address" 
                    cols="50"
                    rows="6"
                    class="text-area apperance none bg-gray-50 border border-gray-700 text-gray-700 rounded leading-tight py-3 px-4 ">{{ $user->address ?? 0 }}</textarea>
            </div>  

            <button 
                type="submit"
                class="uppercase mt-10 shadow-lg bg-yellow-500 hover:bg-yellow-400 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-2xl">
                Update Profile
            </button>
        </form>
    </div>
@endsection
