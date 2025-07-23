<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function product_variants(){
        return $this->belongsTo(Product::class,'product_id','id');

    }
    public function product_ids(){
        $varian = self::all();
        return $varian->pluck('product_id')->toArray();
    }


}
