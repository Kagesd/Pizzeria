<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description', 
        'price',
        'category_id',
        'preview_image',
        'main_image'
    ];
    protected $table = 'products';
    protected $guarded = false;
    use HasFactory;

    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
