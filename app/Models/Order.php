<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'price',
        'user_id'

    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->with(['store']);
    }

    public function orderDetail(){
        return $this->hasMany(OrderDetail::class,'order_id','id')->with(['getProduct']);
    }
}
