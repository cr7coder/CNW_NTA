<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Make sure 'store_id' is the correct field name in your database
    protected $fillable = ['store_id', 'name', 'description', 'price'];

    // Fixing the relationship with the Store model
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
