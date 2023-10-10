<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'menu_id','status','total'];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function wali(){
        return $this->belongsTo(Wali::class);
    }
    public function anak(){
        return $this->belongsTo(Anak::class);
    }
}
