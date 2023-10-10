<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class Menucontroller extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return response()->json(['menu' => $menus], 200);
    }

    public function show($id)
    {
        $menus = Menu::find($id);
        return response()->json([
            'status'=>200,
            'menu'=>$menus,
            'massage'=>'data tidak ada'
        ]);
    } 

    public function create(Request $request)
{
    // Validasi data dari permintaan
    $validator = Validator::make($request->all(), [
        'gambar' => 'nullable|string',
        'nama_menu' => 'required|string',
        'deskripsi' => 'required|string',
        'harga' => 'required|string',
        'tanggal' => 'required|date',
        'category_id' => 'required|exists:categories,id', // Pastikan category_id ada dalam tabel categories
    ]);

    if ($validator->fails()) {
        // Jika validasi gagal, kirim respons dengan pesan kesalahan
        return response()->json(['error' => $validator->errors()], 422);
    }

    // Simpan data menu baru ke database
    $menu = Menu::create($request->all());

    if ($menu) {
        return response()->json(['menu' => $menu], 201);
    } else {
        // Jika gagal menyimpan data menu, kirim respons server error
        return response()->json(['error' => 'Terjadi kesalahan saat membuat menu.'], 500);
    }
}
    

    
    public function update(Request $request, $id)
    {
        // Validasi data dari formulir
        $request->validate([
            'gambar' => 'nullable|string',
            'nama_menu' => 'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'tanggal' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Temukan menu berdasarkan ID
        $menu = Menu::find($id);

        // Cek apakah menu ditemukan
        if (!$menu) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    
        // Perbarui data menu
        $menu->update($request->all());
    
        return response()->json(['success' => 'Data berhasil diperbarui.'], 200);
    }

    public function destroy($id)
    {
        // Temukan menu berdasarkan ID
        $menu = Menu::find($id);

        // Cek apakah menu ditemukan
        if (!$menu) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }

        // Hapus menu
        $menu->delete();

        return response()->json(['success' => 'Data berhasil dihapus.'], 200);
    }

}
