<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $table = 'seats';
    protected $primaryKey = 'SeatID';
    public $timestamps = true;

    protected $fillable = [
        'ExternalBusID',
        'SeatNumber',
        'IsBooked',
    ];

    public function externalBus()
    {
        return $this->belongsTo(ExternalBus::class, 'ExternalBusID', 'ExternalBusID');
    }
}
