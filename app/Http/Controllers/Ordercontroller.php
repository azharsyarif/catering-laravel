<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Ordercontroller extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json(['order' => $orders], 200);
    }

    public function create(Request $request)
{
    // Validasi data dari permintaan
    $validator = Validator::make($request->all(), [
        'wali_id' => 'required|string',
        'menu_id' => 'required|string',
        'tanggal-pemesanan' => 'date',
        'anak_id' => 'required|string',
    ]);

    if ($validator->fails()) {
        // Jika validasi gagal, kirim respons dengan pesan kesalahan
        return response()->json(['error' => $validator->errors()], 422);
    }
    
    // Simpan data menu baru ke database
    $order = Order::create($request->all());

    if ($order) {
        return response()->json(['order' => $order], 201);
    } else {
        // Jika gagal menyimpan data order, kirim respons server error
        return response()->json(['error' => 'Terjadi kesalahan saat membuat pesanan.'], 500);
    }
}

    
    public function update(Request $request, $id)
    {
        // Validasi data dari formulir
        $request->validate([
            'wali_id' => 'required|string',
            'menu_id' => 'required|string',
            'tanggal-pemesanan' => 'date',
            'anak_id' => 'required|string',
        ]);

        $order = Order::find($id);


        if (!$order) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    

        $order->update($request->all());
    
        return response()->json(['success' => 'Data berhasil diperbarui.'], 200);
    }
    
    public function delete($id)
    {
        $walis = Order::find($id);

        if (!$walis) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }

        $walis->delete();

        return response()->json(['success' => 'Data berhasil dihapus.'], 200);
    }

}
