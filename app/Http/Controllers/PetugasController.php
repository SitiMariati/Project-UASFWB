<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'petugas') {
                return redirect()->route('petugas.dashboard');
            }
        }

        return redirect()->back()->withErrors(['Invalid credentials']);
    }

    public function dashboard()
    {
        return view('petugas.dashboard');
    }
}