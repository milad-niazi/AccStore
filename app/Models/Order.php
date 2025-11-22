<?php

namespace App\Models;

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'order_items');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
