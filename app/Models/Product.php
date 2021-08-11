<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table="produk";
    protected $fillable = ['produk','user_id', 'kategori_id', 'harga', 'stok', 'deskripsi'];

    public function gambar()
    {
        return $this->hasMany(ProductGallery::class, 'produk_id', 'id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id', 'id');
    }
}
