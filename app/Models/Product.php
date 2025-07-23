<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    public function images(){
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
    public function variants(){
        return $this->hasMany(Variant::class, 'product_id', 'id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')->withTimestamps();
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function product_images(){
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function inventories(){
        return $this->hasOne(Inventory::class, 'product_id', 'id');
    }

    public function ratings(){
        return $this->hasMany(Rating::class, 'product_id', 'id');
    }

}
