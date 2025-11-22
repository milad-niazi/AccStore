<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_items';

    protected $guarded = [];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
