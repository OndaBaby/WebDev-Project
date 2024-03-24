<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';

    protected $fillable = ['customer_id', 'product_id', 'comments', 'img_path'];

    public function productF() {
        return $this->belongsTo(Product::class);
    }

    public function customerF() {
        return $this->belongsTo(Feedback::class);
    }
}
