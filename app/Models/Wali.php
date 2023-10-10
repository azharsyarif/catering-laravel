<?php

namespace App\Models;

// use App\Models\Anak;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wali extends Model
{
    use HasFactory;
    use HasApiTokens;
    use Notifiable;
    protected $fillable = [
        'id',
        'nama',
        'email',
        'password',
        'noTelepon',
        // 'anak_id',
        // Kolom-kolom lain yang ingin Anda masukkan ke dalam fillable
    ];

    protected $hidden = [
        'password',
        'createToken',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function setRole($role)
    {
        $this->attributes['role'] = $role;
    }

    public function getRole()
    {
        return $this->attributes['role'];
    }

//     public function anak()
//     {
//         return $this->hasMany(Anak::class);
//     }
    // public function getaAnakDisplayValue()
    //     {
    //         return $this->anak->nama_anak; // Mengambil nama wali sesuai dengan id_wali
    //     }
// }



//Function HASMANY DAN BELONGSTO
    public function anak()
    {
        return $this->hasMany(Anak::class);
    }

        public function anak_id()
    {
        return $this->belongsTo(Anak::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }


    // PDO
    public function getData()
    {
        return DB::select('SELECT * FROM wali');
    }
}