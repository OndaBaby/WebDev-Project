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
    protected $fillable = ['customer_id', 'product_id','cart_qty'];

    public function customerC() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function productC() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public static function deleteByKeys($customerId, $productId)
    {
        self::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->delete();
    }
}
