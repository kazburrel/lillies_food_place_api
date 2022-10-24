<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResetPasswordRequest;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
// use Illuminate\Validation\Rules\Password;

class ForgotResetPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        try {
            if ($status == Password::RESET_LINK_SENT) {
                return  response()->json([
                    'status' => __($status)
                ]);
            }
            throw new Exception("You have entered an invalid e-mail address. Please try again", 400);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], $th->getCode());
        }
    }

    public function resetPassword(StoreResetPasswordRequest $request)
    {

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return  response()->json([
                'message' => 'Password reset successful'
            ]);
        }

        return  response()->json([
            'message' => __($status)
        ], 500);
    }
}
