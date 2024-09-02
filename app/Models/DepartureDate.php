<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartureDate extends Model
{
    protected $primaryKey = 'DepartureDateID';
    public $incrementing = true;
    protected $keyType = 'bigint';
    protected $casts = [
        'departure_date' => 'datetime',
        'DepartureDateID' => 'integer',
    ];
    protected $fillable = [
        'departure_date',  // Add this line
        // Add other fillable fields as needed
    ];

    public function externalBus()
    {
        return $this->belongsTo(ExternalBus::class, 'ExternalBusID', 'ExternalBusID');
    }
}
