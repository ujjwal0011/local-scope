<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'description', 'address', 'latitude', 'longitude'
    ];
    

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
}
