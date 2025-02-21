<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['restaurant_id', 'customer_name', 'customer_email', 'reservation_date', 'guest_count'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
