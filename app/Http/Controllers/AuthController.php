<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $user = Auth::user();
            if($user->role == 'admin'){
                return redirect('menu');
            }
            if($user->role == 'owner'){
                return redirect('laporan');
            }
            if($user->role == 'kasir'){
                return redirect('pembayaran');
            }
            if($user->role == 'pelanggan'){
                return redirect('pemesanan');
            }
        }
        return view('login');
    }
    public function login(Request $request)
    {
        try {
            $credentials = $request->only(['email','password']);
            // dd($credentials);
            if(Auth::attempt($credentials)){
                $user = Auth::user();
                $this->log("Melakukan Login!");
                if($user->role == 'admin'){
                    return redirect('menu');
                }
                if($user->role == 'owner'){
                    return redirect('laporan');
                }
                if($user->role == 'kasir'){
                    return redirect('pembayaran');
                }
                if($user->role == 'pelanggan'){
                    return redirect('pemesanan');
                }
            }
            return redirect('login')->with('error', 'Email dan Password salah!');
        } catch (\Throwable $th) {
            return redirect('/')->with('error', $th->getMessage());
        }
    }
    public function logout()
    {
        try {
            $this->log("Melakukan Logout!");
            Auth::logout();
            return redirect('login');
        } catch (\Throwable $th) {
            return redirect('/')->with('error', $th->getMessage());
        }
    }
    public function log($logs)
    {
        try {
            $user = Auth::user();
            Log::create([
                "user_id" => $user->id,
                "activity" => $user->name . " $logs",
            ]);
        } catch (\Throwable $th) {
            return redirect('/')->with('error', $th->getMessage());
        }
    }
}
