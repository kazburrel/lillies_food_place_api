<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersRequest;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerUser(StoreUsersRequest $request)
    {
        // $password = $request->password;
        // dd($password);
        $file = $request->hasFile('user_avatar') ? $request->file('user_avatar')->store('userAvatar', 'public') : '';
        User::create($request->safe()->merge([
            'user_avatar' => $file,
            'password' => Hash::make($request->password)
        ])->all());

        return  response()->json([
            'message' => 'User Created Successfully',
        ]);
    }

    // public function authenticate(Request $request)
    // {

    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     $user = Vendor::where('email', $credentials['email'])->first();
        
    //     // dd($user);
    //     // if (Auth::attempt($credentials)) { 
    //     //     // $request->session()->regenerate();
    //     //     return response()->json([
    //     //         'message'=> 'Logged in'
    //     //     ]);
    //     // }
    //     if (!$user || !Hash::check($credentials['password'], $user['password'])) {
    //         return response([
    //             'error' => 'some error'
    //         ]);
    //     }
    //     // if (Auth::attempt($credentials)) {
    //     // }
    //     dd(auth()->attempt($credentials));
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
