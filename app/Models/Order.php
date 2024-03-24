<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = ['customer_id', 'shipping_fee', 'status', 'date_placed', 'date_shipped'];

    public function customerOrder() {
        return $this->belongsTo(Customer::class)
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }
}
