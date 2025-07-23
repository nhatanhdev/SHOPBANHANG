<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function statuses(){
        {
            return $this->belongsTo(OrderStatus::class, 'status', 'id');
        }
    }

    public function payments(){
        {
            return $this->belongsTo(Payment::class, 'payment', 'id');
        }
    }

    public function order_detail(){
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }


}
