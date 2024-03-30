<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $fillable = ['order_id', 'mode_of_payment', 'date_of_payment'];

    public function orderP() {
        return $this->belongsTo(Order::class);
    }
}
