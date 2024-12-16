<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Jobs\SendResetPasswordEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{    
    /**
     * sendResetLinkEmail
     *
     * @param  mixed $request
     * @return void
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check if the email exists
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            // Dispatch the job to send the email
            SendResetPasswordEmail::dispatch($request->email);

            return Helper::result('Reset link queued for sending', 200, ['status' => __($status)]);
        }

        return Helper::result('Failed to queue reset link', 400, ['error' => __($status)]);
    }


     
    
     /**
      * reset
      *
      * @param  mixed $request
      * @return void
      */
     public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return Helper::result('Password has been reset successfully', 200, ['status' => __($status)]);
        }

        return Helper::result('Failed to reset password', 400, ['error' => __($status)]);
    }
}
