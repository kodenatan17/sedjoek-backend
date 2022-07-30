<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['nullable', 'string', 'max:255'],
                'password' => ['required', 'string', new Password],
            ]);

            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            $user = User::where('email', $request->email)->first(); //get data access where email, karna unique

            $tokenResult = $user->createToken('authToken')->plainTextToken(); // membuat access token

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'User Registered');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went Wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required', //validasi email && required
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthoriazed'
                ], 'Authentication Failed', 500);
            }

            $user = User::where('email', $request->email)->first(); //get data by email

            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials'); //checking password (hash) sama atau tidak
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult, //buat access token baru berdasarkan tokenresult
                'token_type' => 'Bearer',
                'user' => $user //access data user
            ], 'Authenticated');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something Went Wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function fetch(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'Data Profile User berhasil diambil');
    }

    public function updateProfile(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['nullable', 'string', 'max:255'],
                'password' => ['required', 'string', 'max:255'],
            ]);
            $data = $request->all();

            $user = Auth::user();
            $user->update($data);

            return ResponseFormatter::success($user, 'Profile Updated');
        } catch (\Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Terjadi Kesalahan dalam Update',
                'error' => $error,
            ]);
        }

        // $data = $request->all();

        // $user = Auth::user();
        // $user->update($data);

        // return ResponseFormatter::success($user, 'Profile Updated');

    }
}
