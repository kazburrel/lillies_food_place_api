<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersRequest;
use App\http\Service\SessionService;
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
        // $clientIP = request()->ip();
        // $data = request()->location();   

        //     dd($clientIP,$data );
        // $password = $request->password;
        // dd($password);
        $unique_id = "USER" . mt_rand(100000, 999999);
        $file = $request->hasFile('user_avatar') ? $request->file('user_avatar')->store('userAvatar', 'public') : '';
        User::create($request->safe()->merge([
            'unique_id' => $unique_id,
            'user_avatar' => $file,
            'password' => Hash::make($request->password),
            'status' => 1,
            'type' => 'user'
        ])->all());

        return  response()->json([
            'message' => 'User created successfully',
        ]);
    }


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

    public function showUserdetails(Request $request)
    {
        $user = SessionService::getUser($request);
        return $user;
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
