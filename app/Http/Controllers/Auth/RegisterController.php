<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        try{
            $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'Offline',
            'role' => 'user',
        ]);
        }
        catch(\Exception $e){
            // return response()->json(['error' => 'Registration failed. Please try again.'], 422);
            return back()->withErrors(['error' => 'Registration failed. Please try again.']);
            
        }

        // Auth::login($user);

        return redirect('/');
    }
}
