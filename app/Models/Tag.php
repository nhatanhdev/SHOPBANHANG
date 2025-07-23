<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tag_ids(){
        return $this->hasMany(ProductTag::class, 'tag_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tags','product_id', 'tag_id');
    }
}
