<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'discount',
        'business_id',
        'category_id'
    ];
    
    public function business()
    {
        return $this->belongsTo(\App\Models\Business::class);
    }
    
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
    
}
