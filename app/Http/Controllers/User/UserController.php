<?php

namespace App\Http\Controllers\User;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class UserController extends Controller
{
    // public function StoreUserRegister(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'phone' => ['required', 'string', 'max:255','unique:users'],
    //         // Add any other validation rules you need
    //     ]);

    //     if ($validator->fails()) {
    //         return Redirect::back()->withErrors($validator)->withInput();
    //     }

    //     // Generate and store the OTP for the user
    //     $otp = random_int(100000, 999999);

    //     // try {
    //     //     $Account_SID = env('TWILIO_SID');
    //     //     $Auth_Token = env('TWILIO_TOKEN');
    //     //     $number = env('TWILIO_FROM');
    //     //     $client = new Client($Account_SID, $Auth_Token);

    //     //     // Send the SMS with the OTP
    //     //     $client->messages->create("+8801679081425", [
    //     //         'from' => $number,
    //     //         'body' => 'Dear Customer, Your OTP for registration is: ' . $otp . " from t3solution",
    //     //     ]);
    //     // } catch (\Twilio\Exceptions\ConfigurationException $th) {
    //     //     Log::error('Twilio Configuration Exception: ' . $th->getMessage());
    //     //     // Handle the configuration exception, e.g., display an error message
    //     // } catch (\Twilio\Exceptions\TwilioException $th) {
    //     //     Log::error('Twilio Exception: ' . $th->getMessage());
    //     //     // Handle other Twilio exceptions, e.g., display an error message
    //     // } catch (\Throwable $th) {
    //     //     Log::error('Unexpected Exception: ' . $th->getMessage());
    //     //     // Handle unexpected exceptions, e.g., display an error message
    //     // }

    //     // Create the user record with the generated OTP (no password)
    //    User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'otp' => $otp,
    //     ]);

    //     $Phone = Crypt::encrypt($request->phone);
    //     // Redirect the user to the OTP verification page with the encrypted phone number
    //     return redirect()->route('otp.verify', compact('Phone'));
    // }

    public function StoreUserRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'trade_license_number' => ['nullable', 'string', 'max:255'],
            'nid_no' => ['nullable', 'string', 'max:255'],
            'passport_number' => ['nullable', 'string', 'max:255'],
            'bin_num' => ['nullable', 'string', 'max:255'],
            'tin_num' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'post_code' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Create the user record with password (no OTP or email)
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $data = $request->all();
        if (isset($input['company_name'])) {
            $user->userDetails()->create([
                'company_name' => $data['company_name'],
                'trade_license_number' => $data['trade_license_number'],
                'nid_no' => $data['nid_no'],
                'passport_number' => $data['passport_number'],
                'bin_num' => $data['bin_num'],
                'tin_num' => $data['tin_num'],
                'address' => $data['address'],
                'city' => $data['city'],
                'post_code' => $data['post_code'],
                'country' => $data['country'],
            ]);
        }
        // Login the user after successful registration
        Auth::login($user);

        // Redirect the user to the dashboard or another page after successful registration
        return redirect()->route('dashboard');
    }
}
