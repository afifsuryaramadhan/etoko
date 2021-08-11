<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{
    use SoftDeletes;
    protected $table="gambar";
    protected $fillable = ['produk_id','gambar'];

    public function produk()
    {
        return $this->belongsTo(Product::class, 'produk_id', 'id');
    }
}
