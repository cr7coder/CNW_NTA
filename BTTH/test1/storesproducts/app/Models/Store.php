<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['store_name', 'address', 'phone_number']; // Define necessary fields

    // If the store has many products:
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

