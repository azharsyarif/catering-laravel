<?php

namespace App\Http\Controllers;

use App\Models\Wali;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Walicontroller extends Controller
{


    // REGISTER DAN LOGIN METHOD //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|string|unique:walis,email',
            'password' => 'required|string|min:6',
            'noTelepon' => 'required|string', // Menambahkan validasi untuk noTelepon
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
    
        $wali = Wali::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'noTelepon' => $request->noTelepon, // Menambahkan noTelepon ke dalam data yang disimpan
        ]);
    
        $token = $wali->createToken('Personal Access Token')->plainTextToken;
    
        return response()->json(['user' => $wali, 'token' => $token], 200);
    }
    

    public function login(Request $req)
    {
        try {
            // validate
            $rules = [
                'email' => 'required',
                'password' => 'required|string',
            ];
            $req->validate($rules);
    
            $user = Wali::where('email', $req->email)->first();
    
            if ($user && Hash::check($req->password, $user->password)) {
                $token = $user->createToken('Personal Access Token')->plainTextToken;
                $response = ['user' => $user, 'token' => $token];
                return response()->json($response, 200);
            }
    
            $response = ['message' => 'Incorrect email or password'];
            return response()->json($response, 400);
        } catch (\Exception $e) {
            // Tangkap exception dan kirim respons server error
            $response = ['message' => 'Terjadi kesalahan server: ' . $e->getMessage()];
            return response()->json($response, 500);
        }
    }
    







// CRUD METHOD //
    public function index()
    {
        $walis = Wali::all();
        return response()->json(['wali' => $walis], 200);
    }

    public function show($id)
    {
        $wali = Wali::find($id);
    
        if ($wali) {
            // Jika data ditemukan, kirim respons JSON dengan status 200 dan data yang ditemukan
            return response()->json([
                'status' => 200,
                'data' => $wali,
            ]);
        } else {
            // Jika data tidak ditemukan, kirim respons JSON dengan status 404 dan pesan kesalahan
            return response()->json([
                'status' => 404,
                'error' => [
                    'id' => ['Data tidak ditemukan'],
                    
                ],
            ]);
        }
    }

public function create(Request $request)
{
    // Validasi data dari permintaan
    $request->validate([
        'nama' => 'required|string',
        'email' => 'required|string',
        'password' => 'required|string|min:6',
        'noTelepon' => 'required|string',
        'anak_id' => 'required|string',
    ]);

    // Simpan data menu baru ke database
    $wali = Wali::create($request->all());

    if ($wali) {
        return response()->json(['wali' => $wali], 201);
    } else {
        // Jika gagal menyimpan data, kirim respons server error
        return response()->json([
            'status' => 500,
            'error' => 'Terjadi kesalahan server saat menyimpan data wali.',
        ]);
    }
}



    public function update(Request $request, $id)
    {
        // Validasi data dari formulir
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'noTelepon' => 'required|string',
            'anak_id'=> 'required|string'
        ]);

        $walis = Wali::find($id);


        if (!$walis) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }
    

        $walis->update($request->all());
    
        return response()->json(['success' => 'Data berhasil diperbarui.'], 200);
    }

    public function delete($id)
    {
        $walis = Wali::find($id);

        if (!$walis) {
            return response()->json(['error' => 'Data tidak ditemukan.'], 404);
        }

        $walis->delete();

        return response()->json(['success' => 'Data berhasil dihapus.'], 200);
    }

}
