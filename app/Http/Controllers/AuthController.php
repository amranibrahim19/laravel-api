<?php

namespace App\Http\Controllers;

use App\Mail\OTP as MailOTP;
use App\Models\OTP;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        if (Auth::attempt($request->only('username', 'password'))) {
            $user = Auth::user();

            $token = $user->createToken('app')->plainTextToken;

            logger($token);

            return response([
                'user' => $user,
                'token' => $token,
                'message' => 'Success'
            ], 200);
        } else {
            return response([
                'message' => 'Invalid Credentials'
            ], 400);
        }
    }

    // request for otp
    public function otp(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        $otp = rand(1000, 9999);

        $user = User::where('email', $data['email'])->first();

        $count = OTP::where('email', $data['email'])->count();

        if ($count >= 3) {
            return response([
                'message' => 'Maximum OTP limit reached. Please wait for 24 hours'
            ], 400);
        }

        if ($user) {
            return response([
                'message' => 'Email already exists'
            ], 404);
        }

        $otp = OTP::create([
            'email' => $data['email'],
            'otp' => $otp,
        ]);

        // send otp to email
        Mail::to($data['email'])->send(new MailOTP($otp['otp']));

        return response([
            'message' => 'OTP sent to your email'
        ], 200);
    }

    // verify otp
    public function verifyOtp(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric'
        ]);

        $otp = OTP::where('email', $data['email'])
            ->where('otp', $data['otp'])
            ->first();

        if ($otp) {

            $otp->update([
                'status' => true
            ]);

            return response([
                'message' => 'OTP verified'
            ], 200);
        } else {
            return response([
                'message' => 'Invalid OTP'
            ], 400);
        }
    }

    public function register(Request $request)
    {

        try {
            // Validate request data
            $data = $request->validate([
                'name' => 'required|string',
                'username' => 'required|string|unique:users,username',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|min:6',
            ]);

            logger($data);

            // Create new user
            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $token = $user->createToken('app')->plainTextToken;

            // Return a successful response
            return response()->json(
                [
                    'message' => 'User registered successfully',
                    'token' => $token
                ],
                200
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exception
            foreach ($e->errors() as  $value) {
                return response()->json(['message' => $value[0]], 422);
            }
        }
    }


    public function logout(Request $request)
    {
        $user = auth('sanctum')->user();

        // $user->tokens()->delete();

        $request->user()->currentAccessToken()->delete();
    }
}
