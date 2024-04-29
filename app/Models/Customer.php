<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'customer_name', 'serial_number', 'phone_number', 'neighbourhood',
        'download_speed_before_installing', 'download_speed_after_installing',
        'upload_speed_before_installing', 'upload_speed_after_installing',
        'ping_before_installing', 'ping_after_installing', 'internet_tower',
        'cell_number', 'bandwidth_strength_after_installing', 
        'signal_db_after_installing', 'card_used', 'notes', 'extra_notes',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
