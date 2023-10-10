<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = ['id','menu_id', 'wali_id', 'tanggal_pemesanan', 'anak_id', 'status'];

    
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function wali()
    {
        return $this->belongsTo(Wali::class);
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
