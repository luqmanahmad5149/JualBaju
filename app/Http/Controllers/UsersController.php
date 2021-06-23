<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => []]);
    }

    public function show()
    {
        $userId = auth()->user()->id;

        $user = User::where('id', $userId)->first();

        return view('user.show')->with('user', $user);

    }

    public function edit()
    {
        $userId = auth()->user()->id;
        return view('user.edit')->with('user', User::where('id', $userId)->first());
    }

    public function update(Request $request, $id)
    {
        $data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
        );

        DB::table('users')->updateOrInsert(['id'=>$id], $data);

        return redirect('/profile')->with('message', 'Your profile has been updated!');
    }
}
