<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Anakcontroller extends Controller
{
    public function index()
    {
        $anaks = Anak::all();
        return response()->json(['menus' => $anaks], 200);
    }

    public function show($id)
    {
        $anaks = Anak::find($id);
        return response()->json([
            'status'=>200,
            'menu'=>$anaks,
            'massage'=>'data tidak ada'
        ]);
    } 

    public function create(Request $request)
    {
        // Validasi data dari permintaan
        $validator = Validator::make($request->all(), [
            'nama_anak' => 'required|string',
                'kelas' => 'required|string',
                'wali_id' => 'required|exists:walis,id',
        ]);
    
        if ($validator->fails()) {
             // Jika validasi gagal, kirim respons dengan pesan kesalahan
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Simpan data menu baru ke database
        $anaks = Anak::create($request->all());

        return response()->json(['anak' => $anaks], 201);
    }

    public function update(Request $request, $id)
    {
        // Validasi data dari formulir
        $request->validate([
            'nama_anak' => 'required|string',
            'kelas' => 'required|string',
            'wali_id' => 'required|exists:walis,id',
        ]);

        $anaks = Anak::find($id);

        if (!$anaks) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    
        $anaks->update($request->all());
    
        return response()->json(['success' => 'Data berhasil diperbarui.'], 200);
    }

    public function delete($id)
    {
        $anaks = Anak::find($id);

        if (!$anaks) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }

        $anaks->delete();

        return response()->json(['success' => 'Data berhasil dihapus.'], 200);
    }
}
