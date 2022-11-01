<?php

namespace App\http\Service;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\PersonalAccessToken;

class SessionService {
    public static function getUser($request){
        $bearerToken = $request->bearerToken();
        $personalAccessToken = PersonalAccessToken::findToken($bearerToken);
        // dd($bearerToken);
        return  $personalAccessToken->tokenable_type::find($personalAccessToken->tokenable_id);

    }

    // public static function getBearerTok($request){
    //     $bearerToken = $request->bearerToken();
    //    return  $personalAccessToken = PersonalAccessToken::findToken($bearerToken);
    //     // $token_id = PersonalAccessToken::find($personalAccessToken)->first();
    // }
}