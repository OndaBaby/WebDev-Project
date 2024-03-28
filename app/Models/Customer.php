<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $fillable = ['user_id', 'address', 'contact_no'];

    public function feedbackC() {
        return $this->hasMany(Feedback::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
