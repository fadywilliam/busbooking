<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookings extends Model
{
    use HasFactory;
    protected $fillable = [
        'trip_id',
        'seat_id',
        'user_id'
    ];
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function seats()
    {
        return $this->belongsTo('App\Models\seats', 'seat_id', 'id');
    }
    public function trips()
    {
        return $this->belongsTo('App\Models\trips', 'trip_id', 'id');
    }

}
