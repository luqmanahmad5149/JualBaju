@extends('layouts.app')

@section('content')
    @if (session()->has('message'))
    <div id="session_message" class="m-10 text-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Hey!</strong>
        <span class="block sm:inline">{{ session()->get('message') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <a href="#" class="fa fa-times" id="close"></a>
    </div> 
    @endif
    <div class="border-b border-gray-200 mt-4 pb-6 w-4/5 m-auto pt-10 flex justify-center">
        <h4 class="text-3xl font-bold ">User Profile</h4>
    </div>
    <div class="p-10 pt-15 mt-8 mx-52 rounded shadow bg-white">
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl::grid-cols-3">
                        <div>
                <div class="flex flex-col items-center justify-center pb-8 border-r">
                    <div class="w-2/4 pt-5 flex justify-center">
                        <img src="/img/{{ $user->image_Path ?? 'images.png' }}" alt="" class="rounded-full h-32 w-32 object-cover shadow-xl"> 
                    </div>
                    <div class="w-2/4 pt-9 flex justify-center">
                        @if (isset(Auth::user()->id) && Auth::user()->id == $user->id)
                            <a 
                                href="/profile/edit/{{ $user->id }}"
                                class="text-gray-100 text-s p-3 font-bold shadow-lg rounded-2xl bg-yellow-500 hover:bg-yellow-400">
                                Update Profile
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-span-2 pl-13">
                {{-- <div class="md:flex mb-7">
                    <div class="md:w-1/4">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4">
                            Username:
                        </label>
                    </div>
                    <div class="md:w-2/4 pl-20">
                        <p class="text-md text-gray-600">
                            BundleBaruShop
                        </p>
                    </div>
                </div> --}}
                <div class="md:flex mb-7">
                    <div class="md:w-1/4">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4">
                            Name:
                        </label>
                    </div>
                    <div class="md:w-2/4 pl-20">
                        <p class="text-md text-gray-600">
                            {{ $user->name }}
                        </p>
                    </div>
                </div>
                <div class="md:flex mb-7">
                    <div class="md:w-1/4">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4">
                            Email:
                        </label>
                    </div>
                    <div class="md:w-2/4 pl-20">
                        <p class="text-md text-gray-600">
                            {{ $user->email }}
                        </p>
                    </div>
                </div>
                <div class="md:flex mb-7">
                    <div class="md:w-1/4">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4">
                            Phone Number:
                        </label>
                    </div>
                    <div class="md:w-2/4 pl-20">
                        <p class="text-md text-gray-600">
                            +60{{ $user->contact ?? '' }}
                        </p>
                    </div>
                </div>
                <div class="md:flex mb-7">
                    <div class="md:w-1/4">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4">
                            Gender:
                        </label>
                    </div>
                    <div class="md:w-2/4 pl-20">
                        <p class="text-md text-gray-600">
                            {{ $user->gender ?? '' }}
                        </p>
                    </div>
                </div>
                <div class="md:flex mb-7 ">
                    <div class="md:w-1/4">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4">
                            Date Of Birth:
                        </label>
                    </div>
                    <div class="md:w-2/4 pl-20">
                        <p class="text-md text-gray-600">
                            {{ $user->dob ?? '' }}
                        </p>
                    </div>
                </div>
                <div class="md:flex mb-10 ">
                    <div class="md:w-1/4">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4">
                            Address:
                        </label>
                    </div>
                    <div class="md:w-2/4 pl-20">
                        <p class="text-md text-gray-600">
                            {{ $user->address ?? ''}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- <div class="flex flex-col items-center justify-center w-4/5 mx-auto">
    <div class="bg-gray-50 border border-opacity-75 border-gray-300 h-72 my-7 w-2/6 flex flex-col items-center justify-center">
        <img src="https://img.freepik.com/free-photo/portrait-young-bearded-hipster-man-looking-camera-taking-selfie-against-yellow_58466-11455.jpg?size=626&ext=jpg" alt="" class="w-full h-full object-scale-down object-center">
    </div>
    @if (isset(Auth::user()->id) && Auth::user()->id == $user->id)
        <span class="block float-right">
            <a 
                href="/profile/edit/{{ $user->id }}"
                class="text-gray-500 italic hover:text-gray-900 pb-1 text-xl border-b-2 ml-8">
                Update Profile
            </a>
        </span>
        <span class="float-right">
    @endif
    <div class="flex flex-col items-start justify-start w-4/5">
        <h4 class="pb-4 pt-6 text-xl font-bold">
            Name: <span class="font-normal">{{ $user->name }}</span>
        </h4>
        <h4 class="pb-4 pt-6 text-xl font-bold">
            Email: <span class="font-normal">{{ $user->email }}</span>
        </h4>
        <h4 class="pb-4 pt-6 text-xl font-bold">
            Address: <span class="font-normal">{{ $user->address ?? 0 }}</span>
        </h4>
    </div>
</div> --}}