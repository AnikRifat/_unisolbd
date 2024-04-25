<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class OTPValidationController extends Controller
{
    public function showVerificationForm(Request $request)
    {
        // Get the encrypted phone number from the request
        $encryptedPhone = $request->query('Phone');
        // $encryptedUser = $request->query('User');

        // Decrypt the phone number
        $phone = Crypt::decrypt($encryptedPhone);
        // $user = Crypt::decrypt($encryptedUser);

        return view('auth.otp_verify', compact('phone'));
    }

    public function validateOTP(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6'],
            'password' => ['required'],
        ]);

        // Retrieve the user by the phone number and the OTP
        $user = User::where('phone', $request->phone)
            ->where('otp', $request->otp)
            ->first();

        if (! $user) {
            // Invalid OTP provided, redirect back to the OTP validation form with an error message
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
        }

        // Update the user's password and clear the OTP
        $user->update([
            'password' => Hash::make($request->password),
            'otp' => null,
        ]);

        // Log in the user
        Auth::login($user);

        // Redirect the user to the dashboard or another page after successful registration
        return redirect()->route('dashboard');
    }
}
