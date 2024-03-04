<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $no = 1;
        if(Auth::user()->role == 'admin'){
            return view('menu', ['products' => $products, 'no' => $no]);
        }
        return redirect('/')->with('error', 'Halaman Khusus Admin!');
    }
    public function create(Request $request)
    {
        try {
            Product::create([
                "name" => $request->input('name'),
                "price" => $request->input('price'),
            ]);
            $this->log("Membuat Menu " . $request->input('name')."!");
            return redirect('menu');
        } catch (\Throwable $th) {
            return redirect('/')->with('error', $th->getMessage());
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            // dd($request);
            $product = Product::find($id);
            if($product){
                $product->name = $request->input('name');
                $product->price = $request->input('price');
                $product->save();
                $this->log("Mengedit Menu dengan Id ". $id);
                return redirect('menu');
            }
        } catch (\Throwable $th) {
            return redirect('/')->with('error', $th->getMessage());
        }

    }
    public function delete($id)
    {
        try {
            $this->log("Menghapus Menu dengan id " . $id);
            Product::find($id)->delete();
            return redirect('menu');
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