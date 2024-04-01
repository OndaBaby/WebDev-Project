<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'suppliers';
    protected $fillable = ['name', 'type', 'cost', 'img_path'];

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
