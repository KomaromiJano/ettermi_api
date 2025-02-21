<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'location', 'capacity'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
