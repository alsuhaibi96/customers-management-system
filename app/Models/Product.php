<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['name','description','image','reviews'];

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
    
    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_product')->withPivot(['quantity']);
    }
}
