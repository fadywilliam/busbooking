<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trips extends Model
{
    use HasFactory;
    protected $fillable = [
        'from',
        'to',
        'available_seats'
    ];
    public function cities_from()
    {     
        return $this->belongsTo('App\Models\cities', 'from', 'id');
    }
    public function cities_to()
    {
        return $this->belongsTo('App\Models\cities', 'to', 'id');
    }
}
