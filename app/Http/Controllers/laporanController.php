<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class laporanController extends Controller
{
    public function index()
    {
        $products = Transaction::where('status', true)->get();
        $no = 1;
        if(Auth::user()->role == 'owner' || Auth::user()->role == 'admin'){
            return view('laporan', ['products' => $products, 'no' => $no]);
        }
        return redirect('/')->with('error', 'Halaman Khusus Owner dan Admin!');
    }
    public function delete($id)
    {
        try {
            $this->log("Menghapus Laporan!");
            Transaction::find($id)->delete();
            return redirect('laporan');
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
