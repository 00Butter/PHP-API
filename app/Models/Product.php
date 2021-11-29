<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'order_num',
        'order_date'
    ];

    public function user() {
        return $this->belongsTo( \App\Models\User::class ); 
    }
}
