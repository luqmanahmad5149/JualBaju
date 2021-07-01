@extends('layouts.app')

@section('content')
    <div class="border-b border-gray-200 mt-4 pb-4 w-4/5 m-auto pt-10">
        <h4 class="text-3xl font-bold ">Update Profile</h4>
    </div>

    <div class="w-4/5 m-auto pt-10">
        <form 
            action="/profile/update/{{ $user->id }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="grid xs:grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2">
                <div>
                    <div class="mb-8 mt-3 flex justify-center items-center">
                        <div class="bg-grey-lighter">
                            <label class="w-40 h-40 flex justify-center items-center px-2 py-2 bg-white-rounded-lg shadow-sm hover:shadow-md tracking-wide uppercase border border-gray-700 cursor-pointer bg-white rounded-full">
                                <span class="fas fa-user fa-7x text-gray-700 mb-3"></span>
                                <input 
                                    type="file" 
                                    name="image" 
                                    class="hidden">
                            </label>
                        </div>
                    </div>
        
                    <div class="mb-4 flex justify-start items-center">
                        <div class="w-32">
                            <label class="uppercase tracking-wide text-gray-700 text-l font-bold">Name: </label>
                        </div>
                        <div class="w-2/3">
                            <input 
                                type="text" 
                                name="name"
                                value="{{ $user->name }}"
                                class="appearance-none w-full h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
                        </div>
                    </div>
        
                    <div class="mb-4 flex justify-start items-center">
                        <div class="w-32">
                            <label class="uppercase tracking-wide text-gray-700 text-l font-bold">Email: </label>
                        </div>
                        <div class="w-2/3">
                            <input 
                                type="text" 
                                name="email"
                                value="{{ $user->email }}"
                                class="appearance-none w-full h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
                        </div>
                    </div>
        
                    <div class="mb-4 flex justify-start items-center">
                        <div class="w-32">
                            <label class="uppercase tracking-wide text-gray-700 text-l font-bold">Contact: </label>
                        </div>
                        <div class="w-2/3">
                            <input 
                                type="text" 
                                name="contact"
                                value="{{ $user->contact ?? '' }}"
                                class="appearance-none w-full h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
                        </div>
                    </div>
                </div>
                
                <div class="pl-20 bo border-l">
                    <div class="mb-5 flex flex-col justify-centers items-start">
                        <div class="w-32">
                            <label class="uppercase tracking-wide text-gray-700 text-l font-bold">Date of Birth: </label>
                        </div>
                        <div class="w-1/3 mt-3">
                            <input type="date" name="dob" value="{{ $user->dob ?? '' }}" class="h-10 bg-gray-50 text-gray-700 border border-gray-700 rounded py-3 px-4 mb-3">
                        </div>
                    </div>
        
                    <div>
                        <div class="mb-7 flex flex-col justify-centers items-start">
                            <div class="w-32">
                                <label class="uppercase tracking-wide text-gray-700 text-l font-bold">Gender: </label>
                            </div>
                            <div class="w-1/3 mt-3">
                                @if ($user->gender == 'Male')
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="gender" value="Male" checked>
                                        <span class="ml-2 text-gray-700">Male</span>
                                    </label>
                                    <label class="inline-flex items-center ml-6">
                                        <input type="radio" class="form-radio" name="gender" value="Female">
                                        <span class="ml-2 text-gray-700">Female</span>
                                    </label>
                                @elseif ($user->gender == 'Female')
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="gender" value="Male">
                                        <span class="ml-2 text-gray-700">Male</span>
                                    </label>
                                    <label class="inline-flex items-center ml-6">
                                        <input type="radio" class="form-radio" name="gender" value="Female" checked>
                                        <span class="ml-2 text-gray-700">Female</span>
                                    </label>
                                @else
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="gender" value="Male">
                                        <span class="ml-2 text-gray-700">Male</span>
                                    </label>
                                    <label class="inline-flex items-center ml-6">
                                        <input type="radio" class="form-radio" name="gender" value="Female">
                                        <span class="ml-2 text-gray-700">Female</span>
                                    </label>
                                @endif
                            </div>
                          </div>
                    </div>
        
                    <div class="block mb-1">
                        <label class="uppercase tracking-wide text-gray-700 text-l font-bold pr-10 block pb-4">Address: </label>
                        <textarea 
                            name="address" 
                            cols="50"
                            rows="6"
                            class="text-area apperance none bg-gray-50 border border-gray-700 text-gray-700 rounded leading-tight py-3 px-4 ">{{ $user->address ?? '' }}</textarea>
                    </div>  
        
                    <div>
                        <button 
                            type="submit"
                            class="uppercase mt-10 shadow-lg bg-yellow-500 hover:bg-yellow-400 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-2xl">
                            Update Profile
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
