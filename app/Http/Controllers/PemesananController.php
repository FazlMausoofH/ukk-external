<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $transactions = Transaction::where('name', Auth::user()->name)->get();
        // dd($transactions);
        $no = 1;
        if(Auth::user()->role == 'pelanggan' || Auth::user()->role == 'admin'){
            return view('pemesanan', ['products' => $products, 'no' => $no, 'transactions' => $transactions]);
        }
        return redirect('/')->with('error', 'Halaman Khusus Pelanggan dan Admin!');
    }
    public function create(Request $request)
    {
        try {
            // dd($request);
        $object = $request->input('object');
        $total = 0;
        $user = Auth::user();
        $detail = []; 

        foreach ($object as $productId => $qty) {
            $data = Product::find($productId);
            if($data && $qty > 0){
                $productName = $data->name;
                $productPrice = $data->price;
                $total += $data->price * $qty;

                $detail[] = [
                    "id" => $productId,
                    "name" => $productName,
                    "price" => $productPrice,
                    "quantity" => $qty,
                ];
            }
        }
        Transaction::create([
            "detail" => json_encode($detail),
            "name" => $user->name,
            "total" => $total,
        ]);
        $this->log("Membuat Pesanan");
        return redirect('pemesanan');
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
    // 'image' => $this->upload($request, 'image'),
    // public function upload(Request $request, $inputName)
    // {
    //     $path = $request->file($inputName)->store('public/uploads');
    //     $url = Storage::url($path);
    //     return $url;
    // }
}
