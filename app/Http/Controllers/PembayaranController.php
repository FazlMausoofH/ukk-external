<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $products = Transaction::where('status', false)->get();
        $no = 1;
        if(Auth::user()->role == 'kasir' || Auth::user()->role == 'admin'){
            return view('pembayaran', ['products' => $products, 'no' => $no]);
        }
        return redirect('/')->with('error', 'Halaman Khusus Kasir dan Admin!');
    }
    public function update(Request $request, $id)
    {
        // dd($request);
        $orderId = Carbon::now()->setTimezone('asia/jakarta')->format('YmdHis');
        $product = Transaction::find($id);
        if($product){
            $product->orderid = $orderId;
            $product->pay = $request->input('pay');
            $product->return = $request->input('pay') - $product->total;
            $product->status = true;
            $product->save();
            return redirect('pembayaran');
        }
    }
    public function delete($id)
    {
        try {       
            $this->log("Menghapus Pemesanan dengan id " . $id);
            Transaction::find($id)->delete();
            return redirect('pembayaran');
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
