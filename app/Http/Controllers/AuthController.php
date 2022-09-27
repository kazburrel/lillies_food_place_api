<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthRequest;
use App\http\Service\SessionService;
use App\Models\Admin;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

// class AuthController extends Controller
// {
//     public function authenticate(Request $request)
//     {
//         $credentials = $request->validate([
//             'email' => ['required', 'email'],
//             'password' => ['required'],
//         ]);

//         if (Auth::attempt($credentials)) {
//         }

//         $token = $request->user()->createToken('userToken')->plainTextToken;
//         return  response()->json([
//             'message' => 'User logged Successfully',
//             'token' => $token
//         ]);
//     }

//     // public function logout(Request $request){
//     //     $user = Auth::user();

//     //     $user->tokens()->delete();

//     //     return [
//     //         'message' => 'Logged Out'
//     //     ];
//     // }
// }

class AuthController extends Controller
{

    private function authModels()
    {
        return [
            'user' => [
                'class' => User::class,
            ],
            'vendor' => [
                'class' => Vendor::class,
            ],
             'admin' => [
                'class' => Admin::class,
            ],
        ];
    }


    /**
     * Authentication for mutilple model guards
     * - Each guard is registered in the auth models function as a multi-dimensional array
     * - In the authenticate function map through the auth models array and check which model has the logged in email
     * - If the email exists, return an array with the guard and and the route
     * - Next, check wether the length array returned is greater than 0 
     * - If the length is not greater than 0, return the error message (That means that none of the authentication models had the email)
     * - Else get the guard from the mapped array result
     */
    /**
     * loop through the array to get the particular key as a string
     * set a var of guard outside the loop to null
     *  
     * loop through the authModels using the request 
     * then check with an if statement to know where the data coming from the request exixts() on the models of the array
     * then return the $guard = $key
     * 
     * Then use an if statement to check if the model is null or contains a value, if  its null send him back with error message,
     * but if it has the correct credentials pass it to the auth guard.
     */
    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $guard = $this->getKey($request);
        dd($this->getKey($request));
        if ($guard === null) return response()->json(['message' => 'Invalid credentials']);
        $stats = $guard::where('email', $request->email)->first();
        dd($stats);

        auth()->shouldUse($guard);

        if (Auth::attempt($credentials)) {
        }
       
        $token = $request->user()->createToken( $this->getUserTokName($guard))->plainTextToken;
        return  response()->json([
            'message' => 'You are now logged in',
            'token' => $token
        ]);
    }

    public function logout(Request $request){
        $user = SessionService::getUser($request);
        // dd($user);
        $user->tokens()->delete();
        return  response()->json([
            'message' => 'You are now logged out',
        ]);
    }

    private function getUserTokName($guard)
    {
        if ($guard === 'vendor') {
           return 'vendorTok';
        } elseif ($guard === 'user') {
           return 'userTok';
        } else {
           return 'adminTok';
        }
    }

    private function getKey($request)
    {
        $guard = null;
        foreach ($this->authModels() as $key => $value) {
            if ($value['class']::where('email', $request->email)->exists()) {
                $guard = $key;
            }
        }
        return $guard;
    }
}
