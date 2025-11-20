<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'accounts';

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'sold_to');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items');
    }
}
