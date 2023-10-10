<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['gambar', 'nama_menu' , 'deskripsi', 'harga', 'tanggal','category_id'];

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}