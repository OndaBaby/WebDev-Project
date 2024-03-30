<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'type', 'cost', 'img_path'];

    public function getImgPathsAttribute($value)
    {
        return explode(',', $value);
    }

    public function stocks()
    {
        return $this->hasMany(Inventory::class);
    }

    public function feedbacks() {
        return $this->hasMany(Feedback::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }
}
