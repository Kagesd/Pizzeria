<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'city',
        'country',
        'order_id'
    ];

    public function order()
    {
        return $this->belongsTo(order::class);
    }
}
