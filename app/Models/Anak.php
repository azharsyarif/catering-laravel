<?php

namespace App\Models;

use App\Models\Wali;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anak extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nama_anak', 'kelas', 'wali_id'];
    
    public function wali()
    {
        return $this->belongsTo(Wali::class);
    }
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function wali_id()
    {
        return $this->hasMany(Wali::class);
    }
    public function getWaliDisplayValue()
    {
        return $this->wali->nama; // Mengambil nama wali sesuai dengan id_wali
    }

}
