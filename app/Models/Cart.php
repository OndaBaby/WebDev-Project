<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = ['customer_id', 'product_id', 'quantity'];

    public function customerC() {
        return $this->belongsTo(Customer::class);
    }

    public function productC() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
