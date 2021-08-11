<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table="keranjang";
    protected $fillable = ['user_id', 'produk_id'];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'produk_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
