<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Categorycontroller extends Controller
{
    public function index()
    {
        $cate = Category::all();
        return response()->json(['category' => $cate], 200);
    }

    public function show($id)
    {   
        $cate = Category::find($id);
        return response()->json([
            'status'=>200,
            'category'=>$cate,
            'massage'=>'data tidak ada'
        ]);
    } 

    public function create(Request $request)
    {
        // Validasi data dari permintaan
        $validator = Validator::make($request->all(), [
            'name' =>'required|string',
            'status' => 'required|in:visible,hidden'
        ]);
    
        if ($validator->fails()) {
             // Jika validasi gagal, kirim respons dengan pesan kesalahan
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Simpan data menu baru ke database
        $cate = Category::create($request->all());

        return response()->json(['category' => $cate], 201);
    }
    
    public function update(Request $request, $id)
    {
        // Validasi data dari formulir
        $request->validate([
            'name' =>'required|string',
            'status' => 'required|in:visible,hidden'
        ]);

        // Temukan menu berdasarkan ID
        $cate = Category::find($id);

        // Cek apakah menu ditemukan
        if (!$cate) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    
        // Perbarui data menu
        $cate->update($request->all());
    
        return response()->json(['success' => 'Data berhasil diperbarui.'], 200);
    }

    public function destroy($id)
    {
        // Temukan menu berdasarkan ID
        $cate = Category::find($id);

        // Cek apakah menu ditemukan
        if (!$cate) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }

        // Hapus menu
        $cate->delete();

        return response()->json(['success' => 'Data berhasil dihapus.'], 200);
    }
}
